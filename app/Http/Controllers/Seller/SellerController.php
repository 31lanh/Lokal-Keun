<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SellerController extends Controller
{
    /**
     * Show UMKM registration form
     */
    public function showDaftarForm()
    {
        // Jika sudah pernah daftar, redirect ke dashboard atau edit page
        if (auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Anda sudah terdaftar sebagai UMKM.');
        }

        return view('penjual.daftar');
    }

    /**
     * Store UMKM registration data
     */
    public function storeDaftar(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(['kuliner', 'fashion', 'kerajinan', 'pertanian', 'jasa'])],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'tahun_berdiri' => ['nullable', 'integer', 'min:1900', 'max:2099'],
            'deskripsi' => ['required', 'string', 'min:50'],
            'telepon' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'alamat' => ['required', 'string'],
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'], // Max 5MB per file
        ], [
            'nama_usaha.required' => 'Nama usaha wajib diisi',
            'kategori.required' => 'Kategori usaha wajib dipilih',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi',
            'deskripsi.required' => 'Deskripsi usaha wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 50 karakter',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'alamat.required' => 'Alamat lengkap wajib diisi',
            'photos.*.image' => 'File harus berupa gambar',
            'photos.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'photos.*.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Cek apakah user sudah pernah daftar
        if (auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda sudah terdaftar sebagai UMKM.');
        }

        try {
            DB::beginTransaction();

            // Create UMKM record
            $umkm = Umkm::create([
                'user_id' => auth()->id(),
                'nama_usaha' => $validated['nama_usaha'],
                'kategori' => $validated['kategori'],
                'nama_pemilik' => $validated['nama_pemilik'],
                'tahun_berdiri' => $validated['tahun_berdiri'] ?? null,
                'deskripsi' => $validated['deskripsi'],
                'telepon' => $validated['telepon'],
                'email' => $validated['email'] ?? auth()->user()->email,
                'alamat' => $validated['alamat'],
                'status' => 'pending', // Default pending, nunggu approval admin
            ]);

            // Handle photo uploads
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                $order = 0;

                foreach ($photos as $index => $photo) {
                    // Generate unique filename
                    $filename = 'umkm_' . $umkm->id . '_' . time() . '_' . $index . '.' . $photo->getClientOriginalExtension();

                    // Store photo
                    $path = $photo->storeAs('umkm/photos', $filename, 'public');
                    $url = Storage::url($path);

                    // Create photo record
                    UmkmPhoto::create([
                        'umkm_id' => $umkm->id,
                        'photo_path' => $path,
                        'photo_url' => $url,
                        'is_primary' => $index === 0, // First photo as primary
                        'order' => $order++,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('seller.dashboard')
                ->with('success', 'Pendaftaran UMKM berhasil! Data Anda sedang dalam proses review oleh admin.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show seller dashboard
     */
    public function dashboard()
    {
        // Jika belum daftar UMKM, redirect ke form daftar
        if (!auth()->user()->hasCompletedUmkmRegistration()) {
            return redirect()->route('seller.daftar')
                ->with('info', 'Silakan lengkapi data UMKM Anda terlebih dahulu.');
        }

        $umkm = auth()->user()->umkm;

        return view('seller.dashboard', compact('umkm'));
    }

    /**
     * Edit UMKM data
     */
    public function editUmkm()
    {
        $umkm = auth()->user()->umkm;

        if (!$umkm) {
            return redirect()->route('seller.daftar');
        }

        return view('seller.edit', compact('umkm'));
    }

    /**
     * Update UMKM data
     */
    public function updateUmkm(Request $request)
    {
        $umkm = auth()->user()->umkm;

        if (!$umkm) {
            return redirect()->route('seller.daftar');
        }

        // Validasi input
        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:255'],
            'kategori' => ['required', Rule::in(['kuliner', 'fashion', 'kerajinan', 'pertanian', 'jasa'])],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'tahun_berdiri' => ['nullable', 'integer', 'min:1900', 'max:2099'],
            'deskripsi' => ['required', 'string', 'min:50'],
            'telepon' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'alamat' => ['required', 'string'],
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:5120'],
        ]);

        try {
            DB::beginTransaction();

            // Update UMKM data
            $umkm->update($validated);

            // Handle new photo uploads
            if ($request->hasFile('photos')) {
                $photos = $request->file('photos');
                $currentMaxOrder = $umkm->photos()->max('order') ?? -1;
                $order = $currentMaxOrder + 1;

                foreach ($photos as $index => $photo) {
                    $filename = 'umkm_' . $umkm->id . '_' . time() . '_' . $index . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('umkm/photos', $filename, 'public');
                    $url = Storage::url($path);

                    UmkmPhoto::create([
                        'umkm_id' => $umkm->id,
                        'photo_path' => $path,
                        'photo_url' => $url,
                        'is_primary' => false,
                        'order' => $order++,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('seller.dashboard')
                ->with('success', 'Data UMKM berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete photo
     */
    public function deletePhoto($photoId)
    {
        $photo = UmkmPhoto::where('umkm_id', auth()->user()->umkm->id)
            ->findOrFail($photoId);

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
