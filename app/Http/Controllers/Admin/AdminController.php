<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm;
use Illuminate\Http\Request;

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
     * Hapus Pengguna
     */
    public function userDestroy($id)
    {
        // Cegah admin menghapus dirinya sendiri
        if ($id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->profile_photo_path) {
            $path = $user->profile_photo_path;
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                // If it's a URL (Cloudinary), we can't easily delete via Storage invalidating the path, 
                // but we could try if we had the public ID. For now, we just skip deletion to avoid errors.
                // Or we could try Cloudinary::uploadApi()->destroy($publicId) if we extracted it.
            } else {
                 if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
                }
            }
        }

        // Jika dia punya UMKM, hapus juga data UMKM-nya (Opsional, tergantung kebijakan)
        // $user->umkm()->delete(); 

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
