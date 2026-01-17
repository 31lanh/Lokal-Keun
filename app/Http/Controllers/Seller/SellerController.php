<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmPhoto;
use App\Models\UmkmMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_usaha'    => ['required', 'string', 'max:255'],
            'kategori'      => ['required', Rule::in(['kuliner', 'fashion', 'kerajinan', 'pertanian', 'jasa'])],
            'nama_pemilik'  => ['required', 'string', 'max:255'],
            'tahun_berdiri' => ['nullable', 'integer', 'min:1900', 'max:2099'],
            'deskripsi'     => ['required', 'string', 'min:50'],
            'telepon'       => ['required', 'string', 'max:20'],
            'email'         => ['nullable', 'email', 'max:255'],
            'alamat'        => ['required', 'string'],
            
            // Field Tambahan
            'maps_link'     => ['nullable', 'url'],
            'jam_buka'      => ['nullable'],
            'jam_tutup'     => ['nullable'],

            // Validasi Foto & Menu
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

            // 2. Simpan Data UMKM
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

            // 3. Simpan Foto Tempat
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $index => $photo) {
                    $filename = 'place_' . $umkm->id . '_' . time() . $index . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('umkm/photos', $filename, 'public');
                    
                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => $path,
                        'photo_url'  => Storage::url($path),
                        'is_primary' => $index === 0,
                        'order'      => $index,
                    ]);
                }
            }

            // 4. Simpan Menu
            if ($request->has('menus')) {
                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $menuPhotoPath = null;
                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                        $menuFilename = 'menu_' . $umkm->id . '_' . uniqid() . '.' . $menuData['photo']->getClientOriginalExtension();
                        $path = $menuData['photo']->storeAs('umkm/menus', $menuFilename, 'public');
                        $menuPhotoPath = Storage::url($path);
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

        // [PENTING] Load relasi agar tidak error count() di view
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

        // Load relasi untuk ditampilkan di form edit
        $umkm->load(['menus', 'photos']);

        return view('penjual.edit', compact('umkm'));
    }

    /**
     * Proses Update Data UMKM (Termasuk Menu & Foto)
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
            // Validasi Menu
            'menus'         => 'nullable|array',
            'menus.*.id'    => 'nullable', // ID untuk menu yg diedit
            'menus.*.name'  => 'required_with:menus',
            'menus.*.price' => 'required_with:menus|numeric',
            'menus.*.photo' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // 1. Update Info Dasar
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

            // 2. Handle Menu (Sync: Create/Update/Delete)
            if ($request->has('menus')) {
                // Ambil semua ID menu yang ada di form submit
                $submittedIds = collect($request->menus)->pluck('id')->filter()->toArray();
                
                // Hapus menu di database yang TIDAK ada di form submit (artinya user menghapusnya dari UI)
                $umkm->menus()->whereNotIn('id', $submittedIds)->delete();

                foreach ($request->menus as $menuData) {
                    if (empty($menuData['name'])) continue;

                    $dataToSave = [
                        'name'        => $menuData['name'],
                        'price'       => $menuData['price'],
                        'description' => $menuData['description'] ?? null,
                    ];

                    // Upload foto baru jika ada
                    if (isset($menuData['photo']) && $menuData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                        $menuFilename = 'menu_' . $umkm->id . '_' . uniqid() . '.' . $menuData['photo']->getClientOriginalExtension();
                        $path = $menuData['photo']->storeAs('umkm/menus', $menuFilename, 'public');
                        $dataToSave['photo_path'] = Storage::url($path);
                    }

                    // Update jika ada ID, Create jika ID null
                    $umkm->menus()->updateOrCreate(
                        ['id' => $menuData['id'] ?? null],
                        $dataToSave
                    );
                }
            } else {
                // Jika user menghapus semua menu dari form
                $umkm->menus()->delete();
            }

            // 3. Handle Tambah Foto Galeri (Append foto baru)
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                // Cari urutan terakhir agar foto baru ada di belakang
                $currentMaxOrder = $umkm->photos()->max('order') ?? -1;
                $order = $currentMaxOrder + 1;

                foreach ($photos as $index => $photo) {
                    $filename = 'place_' . $umkm->id . '_' . time() . $index . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('umkm/photos', $filename, 'public');
                    
                    UmkmPhoto::create([
                        'umkm_id'    => $umkm->id,
                        'photo_path' => $path,
                        'photo_url'  => Storage::url($path),
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
        
        // Hapus file fisik
        $path = str_replace('/storage/', 'public/', $photo->photo_path); 
        if(Storage::exists($path)) {
            Storage::delete($path);
        }
        
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }

    /**
     * Hapus Menu (Dipanggil dari tombol hapus di dashboard)
     */
    public function deleteMenu($menuId)
    {
        // Pastikan menu milik user yang login (Security Check)
        $menu = UmkmMenu::whereHas('umkm', function($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($menuId);

        // Hapus foto jika ada
        if ($menu->photo_path) {
            $path = str_replace('/storage/', 'public/', $menu->photo_path);
            if(Storage::exists($path)) {
                Storage::delete($path);
            }
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }
}