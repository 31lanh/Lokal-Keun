<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmVisit; // Import Model Visit
use Illuminate\Http\Request;

class UmkmDetailController extends Controller
{
    public function show($slug)
    {
        // 1. Cari UMKM berdasarkan slug & Load Relasi
        $umkm = Umkm::with(['menus', 'photos', 'primaryPhoto', 'user'])
            ->where('slug', $slug)
            // ->where('status', 'approved') // Uncomment jika ingin membatasi hanya yang approved
            ->firstOrFail();

        // 2. LOGIKA PENCATATAN KUNJUNGAN (VISIT TRACKING)
        // Kita batasi: 1 IP Address hanya dihitung 1x view per hari untuk UMKM yang sama
        // Tujuannya agar data tidak spam jika user refresh halaman berkali-kali.

        $hasVisitedToday = UmkmVisit::where('umkm_id', $umkm->id)
            ->where('ip_address', request()->ip())
            ->whereDate('created_at', now()->today())
            ->exists();

        // Jika belum tercatat hari ini, simpan ke database
        if (!$hasVisitedToday) {
            UmkmVisit::create([
                'umkm_id' => $umkm->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(), // Info browser/device user
                'user_id' => auth()->id() ?? null, // Rekam ID user jika sedang login, null jika tamu
            ]);
        }

        // 3. Cek Status Buka/Tutup
        $now = now()->format('H:i:s');
        $isOpen = $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;

        // 4. Kirim ke View
        return view('detail', [
            'umkm' => $umkm,
            'isOpen' => $isOpen
        ]);
    }
}
