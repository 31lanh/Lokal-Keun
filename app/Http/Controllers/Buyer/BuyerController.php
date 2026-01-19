<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmMenu;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        // 1. Ambil Menu Rekomendasi (Acak 4 item)
        // Pastikan relasi 'umkm' diload agar bisa ambil nama toko
        $recommendedMenus = UmkmMenu::with('umkm')
            ->inRandomOrder()
            ->take(4)
            ->get();

        // 2. Ambil UMKM Favorit (Sementara ambil 5 terbaru yang sudah diapprove)
        $favoriteUmkms = Umkm::where('status', 'approved')
            ->with('primaryPhoto') // Pastikan relasi ini ada di Model Umkm
            ->latest()
            ->take(5)
            ->get();

        // 3. Statistik Dummy (Nanti diganti tabel Order jika sudah ada)
        $stats = [
            'active_orders' => 0,
            'favorite_umkms' => $favoriteUmkms->count(), // Contoh logika sederhana
            'total_orders' => 0,
            'points' => 150 // Contoh poin statis
        ];

        return view('pembeli.index', compact('recommendedMenus', 'favoriteUmkms', 'stats'));
    }
}
