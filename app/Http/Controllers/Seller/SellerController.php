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

            // Upload Foto Galeri (Multiple)
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

            // Upload Menus
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
     * Dashboard Seller
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
     * Form Edit
     */
    public function editUmkm()
    {
        $umkm = auth()->user()->umkm;
        if (!$umkm) return redirect()->route('seller.daftar');

        $umkm->load(['menus', 'photos']);
        return view('penjual.edit', compact('umkm'));
    }

    /**
     * Update Data UMKM
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

            // Handle Foto Galeri Baru
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
    public function deletePhoto(Request $request, $photoId)
    {
        $photo = UmkmPhoto::where('umkm_id', auth()->user()->umkm->id)->findOrFail($photoId);

        // Hapus fisik file
        $filePath = public_path($photo->photo_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        } elseif (Storage::disk('public')->exists($photo->photo_path)) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $photo->delete();

        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus.'
            ]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function deleteMenu($menuId)
    {
        $menu = UmkmMenu::findOrFail($menuId);
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    public function editBranding()
    {
        $user = auth()->user();
        $umkm = $user->umkm;
        if (!$umkm) return redirect()->route('seller.daftar');
        return view('penjual.branding', compact('umkm', 'user'));
    }

    public function updateBranding(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image',
            'banner' => 'nullable|image',
        ]);
        
        $user = auth()->user();
        $umkm = $user->umkm;

        if ($request->hasFile('logo')) {
             $path = $request->file('logo')->store('profile-photos', 'public');
             $user->update(['profile_photo_path' => $path]);
        }

        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $bannerPath = $bannerFile->store('umkm-photos', 'public');
            
            $existingBanner = UmkmPhoto::where('umkm_id', $umkm->id)->where('is_primary', true)->first();
            
            if ($existingBanner) {
                 $existingBanner->update(['photo_path' => $bannerPath, 'photo_url' => Storage::url($bannerPath)]);
            } else {
                 UmkmPhoto::create([
                    'umkm_id' => $umkm->id,
                    'photo_path' => $bannerPath,
                    'photo_url' => Storage::url($bannerPath),
                    'is_primary' => true,
                    'order' => 0
                 ]);
            }
        }

        return redirect()->route('seller.dashboard')->with('success', 'Tampilan toko diperbarui!');
    }

    /**
     * [BARU] SWITCH ROLE ACTION
     * Mengubah role user dari Pembeli menjadi Penjual
     */
    public function switchRole()
    {
        $user = auth()->user();

        // Security Check: Hanya pembeli yang boleh akses ini
        if ($user->role !== 'pembeli') {
            return redirect()->back(); 
        }

        try {
            // 1. Ubah role jadi penjual
            $user->update(['role' => 'penjual']);

            // 2. Direct ke halaman pendaftaran UMKM (daftar.blade.php)
            return redirect()->route('seller.daftar')->with('success', 'Akun berhasil diupgrade! Silakan lengkapi data usaha Anda.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah role.');
        }
    }
}