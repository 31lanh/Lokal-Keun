<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan import ini ada

class AdminController extends Controller
{
    // Halaman Utama Dashboard Admin
    public function index()
    {
        // Hitung statistik untuk kartu dashboard
        $totalUmkm = Umkm::count();
        $pendingUmkm = Umkm::where('status', 'pending')->count();
        $totalUser = User::where('role', 'pembeli')->count();
        $totalSeller = User::where('role', 'penjual')->count();

        // Ambil 5 UMKM terbaru yang statusnya masih pending
        $latestUmkms = Umkm::with('user')->where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUmkm', 'pendingUmkm', 'totalUser', 'totalSeller', 'latestUmkms'));
    }

    // Halaman List Semua UMKM & Validasi
    public function umkmIndex()
    {
        // Ambil semua UMKM, urutkan dari yang terbaru
        $umkms = Umkm::with('user')->latest()->paginate(10);
        return view('admin.umkm.index', compact('umkms'));
    }

    // Proses Approve UMKM
    public function approveUmkm($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'UMKM berhasil disetujui dan kini aktif.');
    }

    // Proses Reject UMKM
    public function rejectUmkm($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'UMKM telah ditolak.');
    }

    /**
     * Halaman Data Pengguna
     */
    public function usersIndex(Request $request)
    {
        $query = User::query();

        // Fitur Pencarian
        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        // Filter Role (Opsional jika nanti butuh filter dropdown)
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Hapus Pengguna (PERBAIKAN UTAMA DISINI)
     */
    public function userDestroy($id)
    {
        // Cegah admin menghapus dirinya sendiri
        if ($id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user = User::findOrFail($id);

        // 1. Hapus foto profil user jika ada (Cloudinary/Storage)
        if ($user->profile_photo_path) {
            $path = $user->profile_photo_path;
            
            // Cek apakah ini URL (Cloudinary) atau path lokal
            if (!filter_var($path, FILTER_VALIDATE_URL)) {
                 if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            // Jika menggunakan Cloudinary, biasanya kita butuh Public ID untuk menghapus via API.
            // Namun untuk saat ini kita biarkan file di Cloudinary tetap ada agar tidak error,
            // atau Anda bisa tambahkan logika penghapusan Cloudinary disini jika sudah install SDK-nya.
        }

        // 2. HAPUS UMKM TERKAIT (SOLUSI ORPHAN DATA)
        // Cek apakah user memiliki UMKM sebelum dihapus
        if ($user->umkm) {
            // Kita hapus UMKM-nya terlebih dahulu
            $user->umkm->delete();
        }

        // 3. Akhirnya hapus User
        $user->delete();

        return back()->with('success', 'Pengguna dan UMKM terkait berhasil dihapus.');
    }
    /**
     * Verifikasi email user secara manual.
     */
    public function verifyUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->email_verified_at) {
            return back()->with('error', 'User sudah terverifikasi.');
        }

        $user->email_verified_at = now();
        $user->save();

        return back()->with('success', 'Email user berhasil diverifikasi secara manual.');
    }
}