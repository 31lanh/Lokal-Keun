<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmMenu;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome()
    {
        // 1. Ambil 4 UMKM Unggulan (Rating tertinggi & Approved)
        $featuredUmkms = Umkm::where('status', 'approved')
            ->with('primaryPhoto')
            ->orderByDesc('rating')
            ->orderByDesc('total_reviews')
            ->take(4)
            ->get();

        // 2. Statistik Real
        $stats = [
            'total_umkm' => Umkm::where('status', 'approved')->count(),
            'total_products' => UmkmMenu::count(),
            'total_users' => \App\Models\User::where('role', 'pembeli')->count(),
        ];

        return view('welcome', compact('featuredUmkms', 'stats'));
    }

    public function index(Request $request)
    {
        $query = Umkm::where('status', 'approved')->with(['photos', 'menus']);

        // Filter Search Bar 
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhereHas('menus', function ($qMenu) use ($search) {
                        $qMenu->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Kategori
        if ($request->has('categories')) {
            $query->whereIn('kategori', $request->categories);
        }

        // Filter Lokasi
        if ($request->filled('location') && $request->location != 'Semua Lokasi') {
            $query->where('alamat', 'like', "%{$request->location}%");
        }

        // Sorting
        if ($request->sort == 'Terbaru') {
            $query->latest();
        } elseif ($request->sort == 'Terlama') {
            $query->oldest();
        } elseif ($request->sort == 'Rating Tertinggi') {
            $query->orderByDesc('rating');
        } else {
            $query->latest();
        }

        $umkms = $query->paginate(9)->withQueryString();

        // Ambil ID UMKM yang difavoritkan (Untuk tombol Love)
        $favoritedUmkmIds = [];
        if (auth()->check()) {
            $favoritedUmkmIds = auth()->user()->favorites()->pluck('umkm_id')->toArray();
        }

        return view('jelajah', compact('umkms', 'favoritedUmkmIds'));
    }

    public function direktori(Request $request)
    {
        $query = Umkm::where('status', 'approved');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        $umkms = $query->paginate(12);

        // Pastikan variabel favorit juga dikirim jika direktori menggunakan tombol love
        $favoritedUmkmIds = [];
        if (auth()->check()) {
            $favoritedUmkmIds = auth()->user()->favorites()->pluck('umkm_id')->toArray();
        }

        return view('jelajah', compact('umkms', 'favoritedUmkmIds'));
    }

    public function category(Request $request, $slug)
    {
        // [PERBAIKAN 1] Definisikan nama kategori
        $category = $slug; 

        $query = Umkm::where('status', 'approved')->with(['photos', 'menus']);

        // Filter berdasarkan kategori dari URL
        $query->where('kategori', $slug);

        // Filter Search
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhereHas('menus', function ($qMenu) use ($search) {
                        $qMenu->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Lokasi
        if ($request->filled('location') && $request->location != 'Semua Lokasi') {
            $query->where('alamat', 'like', "%{$request->location}%");
        }

        // Sorting
        if ($request->sort == 'Terbaru') {
            $query->latest();
        } elseif ($request->sort == 'Terlama') {
            $query->oldest();
        } elseif ($request->sort == 'Rating Tertinggi') {
            $query->orderByDesc('rating');
        } else {
            $query->latest();
        }

        $umkms = $query->paginate(9)->withQueryString();

        // [PERBAIKAN 2] Tambahkan logika Favorit agar tidak error di view
        $favoritedUmkmIds = [];
        if (auth()->check()) {
            $favoritedUmkmIds = auth()->user()->favorites()->pluck('umkm_id')->toArray();
        }

        // [PERBAIKAN 3] Kirim 'category' dan 'favoritedUmkmIds'
        return view('kategori_detail', compact('umkms', 'category', 'favoritedUmkmIds')); 
    }
}