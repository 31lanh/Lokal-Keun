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
                'status'        => 'pending', // [PENTING] Set default status ke pending
            ]);

            // Upload Foto Galeri (Multiple)
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
                    // Upload ke Cloudinary
                    // getRealPath() digunakan agar Cloudinary uploder bisa membaca file tmp
                    $uploadedFile = $photo->storeOnCloudinary('umkm/photos');
                    
                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => $uploadedFile->getSecurePath(), // URL aman dari Cloudinary
                        'photo_url'  => $uploadedFile->getSecurePath(),
                        'is_primary' => false,
                        'order'      => $index + 1,
                    ]);
                }
            }

            // Upload Menus
            if ($request->has('menus')) {
                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $menuPhotoPath = null;
                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                         $uploadedMenu = $menuData['photo']->storeOnCloudinary('umkm/menus');
                         $menuPhotoPath = $uploadedMenu->getSecurePath();
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
            // Redirect ke dashboard, nanti dicegat oleh logic di method dashboard()
            return redirect()->route('seller.dashboard'); 
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
        // 1. Cek apakah user sudah punya UMKM?
        if (!auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.daftar')
                ->with('info', 'Silakan lengkapi data UMKM Anda terlebih dahulu.');
        }

        $umkm = auth()->user()->umkm;

        // 2. [LOGIC BARU] Cek Status UMKM
        // Jika statusnya 'pending', alihkan ke tampilan menunggu
        if ($umkm->status === 'pending') {
            return view('penjual.pending'); 
        }
        
        // Opsional: Jika direject, bisa diarahkan ke view lain atau tampilkan pesan
        if ($umkm->status === 'rejected') {
             // return view('penjual.rejected', compact('umkm')); 
             // Untuk sementara kita biarkan akses dashboard tapi mungkin dengan alert
        }

        // 3. Jika Approved, baru load data lengkap dashboard
        $umkm->load(['menus', 'photos']);

        // Ambil data kunjungan (Total & Bulan Ini)
        $totalVisits = $umkm->total_visits;
        $monthlyVisits = $umkm->monthly_visits;

        return view('penjual.dashboard', compact('umkm', 'totalVisits', 'monthlyVisits'));
    }

    /**
     * Form Edit
     */
    public function editUmkm()
    {
        $umkm = auth()->user()->umkm;
        if (!$umkm) return redirect()->route('seller.daftar');

        // Opsional: Cek juga di sini jika mau membatasi edit saat pending
        // if ($umkm->status === 'pending') return redirect()->route('seller.dashboard');

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
            'menus.*.is_recommended' => 'nullable',
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

            // Handle Menu Update
            if ($request->has('menus')) {
                $submittedIds = collect($request->menus)->pluck('id')->filter()->toArray();
                $umkm->menus()->whereNotIn('id', $submittedIds)->delete();

                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $dataToSave = [
                        'name'        => $menuData['name'],
                        'price'       => $menuData['price'],
                        'description' => $menuData['description'] ?? null,
                        'is_recommended' => $menuData['is_recommended'] ?? 0, 
                    ];

                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                         $uploadedMenu = $menuData['photo']->storeOnCloudinary('umkm/menus');
                         $dataToSave['photo_path'] = $uploadedMenu->getSecurePath();
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
                $currentMaxOrder = $umkm->photos()->max('order') ?? 0; 
                $order = $currentMaxOrder + 1;

                foreach ($photos as $index => $photo) {
                    $uploadedFile = $photo->storeOnCloudinary('umkm/photos');

                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => $uploadedFile->getSecurePath(),
                        'photo_url'  => $uploadedFile->getSecurePath(),
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
        // Hapus fisik file
        $path = $photo->photo_path;
        if (filter_var($path, FILTER_VALIDATE_URL)) {
             // It's a Cloudinary URL. 
             // To delete, we need to extract public ID.
             // URL: https://res.cloudinary.com/[cloud_name]/image/upload/v[version]/[public_id].[ext]
             // Parsing is tricky without helper. 
             // But usually we can attempt to delete if we stored the 'public_id' OR just leave it.
             // Best practice: Store public_id in database. But we stored URL.
        } else {
            $filePath = public_path($path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            } elseif (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
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
            $uploaded = $request->file('logo')->storeOnCloudinary('profile-photos');
            $user->update(['profile_photo_path' => $uploaded->getSecurePath()]);
        }

        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $uploadedBanner = $bannerFile->storeOnCloudinary('umkm-photos');
            $bannerUrl = $uploadedBanner->getSecurePath();

            $existingBanner = UmkmPhoto::where('umkm_id', $umkm->id)->where('is_primary', true)->first();

            if ($existingBanner) {
                // Opsional: Hapus banner lama dari Cloudinary jika perlu
                $existingBanner->update(['photo_path' => $bannerUrl, 'photo_url' => $bannerUrl]);
            } else {
                UmkmPhoto::create([
                    'umkm_id' => $umkm->id,
                    'photo_path' => $bannerUrl,
                    'photo_url' => $bannerUrl,
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