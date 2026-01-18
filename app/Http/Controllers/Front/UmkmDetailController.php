<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmDetailController extends Controller
{
    public function show($slug)
    {
        // 1. Cari UMKM berdasarkan slug
        // 2. Gunakan 'with' untuk mengambil data relasi (Menu, Foto, User) sekaligus
        //    ini disebut "Eager Loading" biar database tidak dipanggil berkali-kali.
        $umkm = Umkm::with(['menus', 'photos', 'primaryPhoto', 'user'])
            ->where('slug', $slug)
            // ->where('status', 'approved') // Aktifkan ini nanti kalau mau filter cuma yang approved
            ->firstOrFail(); // Kalau slug salah, otomatis 404 Not Found

        // 3. Cek Status Buka/Tutup
        // Kita hitung sederhana di sini atau bisa juga di Blade
        $now = now()->format('H:i:s');
        $isOpen = $now >= $umkm->jam_buka && $now <= $umkm->jam_tutup;

        // 4. Kirim ke View
        return view('detail', [
            'umkm' => $umkm,
            'isOpen' => $isOpen
        ]);
    }
}
