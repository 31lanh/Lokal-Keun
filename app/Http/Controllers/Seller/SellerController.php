<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmPhoto;
use App\Models\UmkmMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class SellerController extends Controller
{
    /**
     * Menampilkan form pendaftaran UMKM
     */
    public function showDaftarForm()
    {
        if (auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai UMKM.');
        }
        return view('penjual.daftar');
    }

    /**
     * Proses Simpan Pendaftaran Baru
     */
    public function storeDaftar(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'    => ['required', 'string', 'max:255'],
            'kategori'      => ['required', Rule::in(['kuliner', 'fashion', 'kerajinan', 'pertanian', 'jasa'])],
            'nama_pemilik'  => ['required', 'string', 'max:255'],
            'tahun_berdiri' => ['nullable', 'integer', 'min:1900', 'max:2099'],
            'deskripsi'     => ['required', 'string', 'min:50'],
            'telepon'       => ['required', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],
            'alamat'        => ['required', 'string'],
            'maps_link'     => ['nullable', 'url'],
            'jam_buka'      => ['nullable'],
            'jam_tutup'     => ['nullable'],
            'photos.*'      => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'],
            'menus'         => ['nullable', 'array'],
            'menus.*.name'  => ['required_with:menus', 'string', 'max:255'],
            'menus.*.price' => ['required_with:menus', 'numeric'],
            'menus.*.photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        if (auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.dashboard');
        }

        try {
            DB::beginTransaction();

            $umkm = Umkm::create([
                'user_id'       => auth()->id(),
                'nama_usaha'    => $validated['nama_usaha'],
                'kategori'      => $validated['kategori'],
                'nama_pemilik'  => $validated['nama_pemilik'],
                'tahun_berdiri' => $validated['tahun_berdiri'] ?? null,
                'deskripsi'     => $validated['deskripsi'],
                'telepon'       => $validated['telepon'],
                'email'         => $validated['email'] ?? auth()->user()->email,
                'alamat'        => $validated['alamat'],
                'maps_link'     => $validated['maps_link'] ?? null,
                'jam_buka'      => $validated['jam_buka'] ?? null,
                'jam_tutup'     => $validated['jam_tutup'] ?? null,
                'status'        => 'pending',
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
                    $filename = 'place_' . $umkm->id . '_' . time() . $index . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('umkm/photos'), $filename);

                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => 'umkm/photos/' . $filename,
                        'photo_url'  => '/umkm/photos/' . $filename,
                        'is_primary' => $index === 0,
                        'order'      => $index,
                    ]);
                }
            }

            if ($request->has('menus')) {
                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $menuPhotoPath = null;
                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                        $menuFilename = 'menu_' . $umkm->id . '_' . uniqid() . '.' . $menuData['photo']->getClientOriginalExtension();
                        $menuData['photo']->move(public_path('umkm/menus'), $menuFilename);
                        $menuPhotoPath = '/umkm/menus/' . $menuFilename;
                    }

                    UmkmMenu::create([
                        'umkm_id'     => $umkm->id,
                        'name'        => $menuData['name'],
                        'price'       => $menuData['price'],
                        'description' => $menuData['description'] ?? null,
                        'photo_path'  => $menuPhotoPath,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('seller.dashboard')
                ->with('success', 'Pendaftaran berhasil! Data Anda sedang direview.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan Dashboard Seller
     */
    public function dashboard()
    {
        if (!auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.daftar')
                ->with('info', 'Silakan lengkapi data UMKM Anda terlebih dahulu.');
        }

        $umkm = auth()->user()->umkm->load(['menus', 'photos']);
        return view('penjual.dashboard', compact('umkm'));
    }

    /**
     * Menampilkan Form Edit
     */
    public function editUmkm()
    {
        $umkm = auth()->user()->umkm;
        if (!$umkm) return redirect()->route('seller.daftar');

        $umkm->load(['menus', 'photos']);
        return view('penjual.edit', compact('umkm'));
    }

    /**
     * Proses Update Data UMKM
     */
    public function updateUmkm(Request $request)
    {
        $umkm = auth()->user()->umkm;
        if (!$umkm) return redirect()->route('seller.daftar');

        $validated = $request->validate([
            'nama_usaha'    => 'required|string|max:255',
            'kategori'      => 'required',
            'nama_pemilik'  => 'required',
            'deskripsi'     => 'required|min:50',
            'telepon'       => 'required',
            'alamat'        => 'required',
            'maps_link'     => 'nullable|url',
            'jam_buka'      => 'nullable',
            'jam_tutup'     => 'nullable',
            'menus'         => 'nullable|array',
            'menus.*.id'    => 'nullable',
            'menus.*.name'  => 'required_with:menus',
            'menus.*.price' => 'required_with:menus|numeric',
            'menus.*.photo' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $umkm->update([
                'nama_usaha'   => $validated['nama_usaha'],
                'kategori'     => $validated['kategori'],
                'nama_pemilik' => $validated['nama_pemilik'],
                'deskripsi'    => $validated['deskripsi'],
                'telepon'      => $validated['telepon'],
                'alamat'       => $validated['alamat'],
                'maps_link'    => $validated['maps_link'] ?? null,
                'jam_buka'     => $validated['jam_buka'] ?? null,
                'jam_tutup'    => $validated['jam_tutup'] ?? null,
            ]);

            // Handle Menu
            if ($request->has('menus')) {
                $submittedIds = collect($request->menus)->pluck('id')->filter()->toArray();
                $umkm->menus()->whereNotIn('id', $submittedIds)->delete();

                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $dataToSave = [
                        'name'        => $menuData['name'],
                        'price'       => $menuData['price'],
                        'description' => $menuData['description'] ?? null,
                    ];

                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                        $menuFilename = 'menu_' . $umkm->id . '_' . uniqid() . '.' . $menuData['photo']->getClientOriginalExtension();
                        $menuData['photo']->move(public_path('umkm/menus'), $menuFilename);
                        $dataToSave['photo_path'] = '/umkm/menus/' . $menuFilename;
                    }

                    $umkm->menus()->updateOrCreate(
                        ['id' => $menuData['id'] ?? null],
                        $dataToSave
                    );
                }
            } else {
                $umkm->menus()->delete();
            }

            // Handle Foto Galeri
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                $currentMaxOrder = $umkm->photos()->max('order') ?? -1;
                $order = $currentMaxOrder + 1;

                foreach ($photos as $index => $photo) {
                    $filename = 'place_' . $umkm->id . '_' . time() . $index . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('umkm/photos'), $filename);

                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => 'umkm/photos/' . $filename,
                        'photo_url'  => '/umkm/photos/' . $filename,
                        'is_primary' => false,
                        'order'      => $order++,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('seller.dashboard')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    /**
     * Hapus Foto Galeri
     */
    public function deletePhoto($photoId)
    {
        $photo = UmkmPhoto::where('umkm_id', auth()->user()->umkm->id)->findOrFail($photoId);

        $filePath = public_path($photo->photo_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        } elseif (Storage::disk('public')->exists($photo->photo_path)) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    /**
     * Hapus Menu
     */
    public function deleteMenu($menuId)
    {
        $menu = UmkmMenu::whereHas('umkm', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($menuId);

        if ($menu->photo_path) {
            $relativePath = ltrim($menu->photo_path, '/');
            $filePath = public_path($relativePath);

            if (File::exists($filePath)) {
                File::delete($filePath);
            } elseif (Storage::disk('public')->exists(str_replace('/storage/', '', $menu->photo_path))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $menu->photo_path));
            }
        }

        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    /**
     * BRANDING: Menampilkan Form Edit Logo & Banner
     */
    public function editBranding()
    {
        $user = auth()->user();
        $umkm = $user->umkm;

        if (!$umkm) {
            return redirect()->route('seller.daftar')->with('error', 'Silakan daftar UMKM terlebih dahulu.');
        }

        return view('penjual.branding', compact('umkm', 'user'));
    }

    /**
     * BRANDING: Update Logo & Banner
     */
    public function updateBranding(Request $request)
    {
        $request->validate([
            'logo'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user = auth()->user();
        $umkm = $user->umkm;

        // 1. UPDATE LOGO
        if ($request->hasFile('logo')) {
            if ($user->profile_photo_path) {
                // Cek storage dulu, kalau tidak ada cek public_path
                if (Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
            }
            $path = $request->file('logo')->store('profile-photos', 'public');
            $user->update(['profile_photo_path' => $path]);
        }

        // 2. UPDATE BANNER
        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $bannerPath = $bannerFile->store('umkm-photos', 'public');

            $existingBanner = UmkmPhoto::where('umkm_id', $umkm->id)
                ->where('is_primary', true)
                ->first();

            if ($existingBanner) {
                // Perbaikan: Gunakan 'photo_path' bukan 'path'
                // Cek file fisik dulu sebelum hapus
                if ($existingBanner->photo_path) {
                    if (Storage::disk('public')->exists($existingBanner->photo_path)) {
                        Storage::disk('public')->delete($existingBanner->photo_path);
                    } elseif (File::exists(public_path($existingBanner->photo_path))) {
                        File::delete(public_path($existingBanner->photo_path));
                    }
                }

                $existingBanner->update([
                    'photo_path' => $bannerPath, // Perbaikan nama kolom
                    'photo_url'  => Storage::url($bannerPath),
                    'file_name'  => $bannerFile->getClientOriginalName(),
                    'file_size'  => $bannerFile->getSize(),
                ]);
            } else {
                UmkmPhoto::create([
                    'umkm_id'    => $umkm->id,
                    'photo_path' => $bannerPath, // Perbaikan nama kolom
                    'photo_url'  => Storage::url($bannerPath),
                    'file_name'  => $bannerFile->getClientOriginalName(),
                    'file_size'  => $bannerFile->getSize(),
                    'is_primary' => true,
                    'order'      => 0
                ]);
            }
        }

        return redirect()->back()->with('success', 'Tampilan toko berhasil diperbarui!');
    }
}
