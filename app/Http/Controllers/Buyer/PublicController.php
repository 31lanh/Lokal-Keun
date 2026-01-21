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
            ->orderByDesc('rating') // [PERBAIKAN] Menggunakan sintaks orderByDesc
            ->orderByDesc('total_reviews') // [TAMBAHAN] Jika rating sama, urutkan berdasarkan jumlah ulasan terbanyak
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
        // [PERBAIKAN] Tambahkan where('status', 'approved') agar toko pending/rejected tidak muncul
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
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('alamat', 'like', "%{$location}%");
                
                // Mapping Kota ke Provinsi (Agar pencarian lebih akurat)
                $maps = [
                    'Jawa Barat' => ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Tasikmalaya', 'Cimahi', 'Sukabumi', 'Cirebon', 'Lembang', 'Garut'],
                    'DKI Jakarta' => ['Jakarta', 'Jaksel', 'Jakpus', 'Jakbar', 'Jakut', 'Jaktim'],
                    'DI Yogyakarta' => ['Yogyakarta', 'Jogja', 'Sleman', 'Bantul', 'Gunung Kidul'],
                    'Jawa Timur' => ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Banyuwangi', 'Kediri'],
                    'Jawa Tengah' => ['Semarang', 'Solo', 'Surakarta', 'Magelang', 'Pekalongan', 'Tegal'],
                    'Banten' => ['Tangerang', 'Serang', 'Cilegon', 'Pandeglang'],
                    'Bali' => ['Denpasar', 'Ubud', 'Badung', 'Gianyar'],
                    'Nusa Tenggara Barat' => ['Mataram', 'Lombok', 'Sumbawa', 'NTB'],
                ];

                if (isset($maps[$location])) {
                    foreach ($maps[$location] as $city) {
                        $q->orWhere('alamat', 'like', "%{$city}%");
                    }
                }
            });
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('alamat', 'like', "%{$location}%");
                
                // Mapping Kota ke Provinsi
                $maps = [
                    'Jawa Barat' => ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Tasikmalaya', 'Cimahi', 'Sukabumi', 'Cirebon', 'Lembang', 'Garut'],
                    'DKI Jakarta' => ['Jakarta', 'Jaksel', 'Jakpus', 'Jakbar', 'Jakut', 'Jaktim'],
                    'DI Yogyakarta' => ['Yogyakarta', 'Jogja', 'Sleman', 'Bantul', 'Gunung Kidul'],
                    'Jawa Timur' => ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Banyuwangi', 'Kediri'],
                    'Jawa Tengah' => ['Semarang', 'Solo', 'Surakarta', 'Magelang', 'Pekalongan', 'Tegal'],
                    'Banten' => ['Tangerang', 'Serang', 'Cilegon', 'Pandeglang'],
                    'Bali' => ['Denpasar', 'Ubud', 'Badung', 'Gianyar'],
                    'Nusa Tenggara Barat' => ['Mataram', 'Lombok', 'Sumbawa', 'NTB'],
                ];

                if (isset($maps[$location])) {
                    foreach ($maps[$location] as $city) {
                        $q->orWhere('alamat', 'like', "%{$city}%");
                    }
                }
            });
        }

        // Filter Rating
        if ($request->filled('rating')) {
            if ($request->rating == 'lt_4') {
                $query->where('rating', '>=', 1)->where('rating', '<', 4);
            } else {
                $query->where('rating', '>=', $request->rating);
            }
        }

        // [PERBAIKAN] Logika Sorting (Termasuk Rating Tertinggi)
        if ($request->sort == 'Terbaru') {
            $query->latest();
        } elseif ($request->sort == 'Terlama') {
            $query->oldest();
        } elseif ($request->sort == 'Rating Tertinggi') {
            $query->orderByDesc('rating'); // Sort berdasarkan bintang tertinggi
        } elseif ($request->sort == 'Rating Terendah') {
            $query->orderBy('rating');
        } else {
            $query->latest(); // Default
        }

        $umkms = $query->paginate(9)->withQueryString();

        // Ambil ID UMKM yang difavoritkan oleh user yang sedang login
        $favoritedUmkmIds = [];
        if (auth()->check()) {
            $favoritedUmkmIds = auth()->user()->favorites()->pluck('umkm_id')->toArray();
        }

        return view('jelajah', compact('umkms', 'favoritedUmkmIds'));
    }

    public function direktori(Request $request)
    {
        // [PERBAIKAN] Pastikan hanya mengambil yang approved
        $query = Umkm::where('status', 'approved');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_usaha', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        $umkms = $query->paginate(12);

        // Menggunakan view jelajah sebagai template
        return view('jelajah', compact('umkms'));
    }

    public function category(Request $request, $slug)
    {
        // [PERBAIKAN] Tambahkan where('status', 'approved')
        $query = Umkm::where('status', 'approved')->with(['photos', 'menus']);

        // Filter berdasarkan kategori dari URL (Slug)
        $query->where('kategori', $slug);

        // Filter Search (tetap memungkinkan pencarian dalam kategori)
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
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('alamat', 'like', "%{$location}%");
                
                // Mapping Kota ke Provinsi
                $maps = [
                    'Jawa Barat' => ['Bandung', 'Bogor', 'Depok', 'Bekasi', 'Tasikmalaya', 'Cimahi', 'Sukabumi', 'Cirebon', 'Lembang', 'Garut'],
                    'DKI Jakarta' => ['Jakarta', 'Jaksel', 'Jakpus', 'Jakbar', 'Jakut', 'Jaktim'],
                    'DI Yogyakarta' => ['Yogyakarta', 'Jogja', 'Sleman', 'Bantul', 'Gunung Kidul'],
                    'Jawa Timur' => ['Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Banyuwangi', 'Kediri'],
                    'Jawa Tengah' => ['Semarang', 'Solo', 'Surakarta', 'Magelang', 'Pekalongan', 'Tegal'],
                    'Banten' => ['Tangerang', 'Serang', 'Cilegon', 'Pandeglang'],
                    'Bali' => ['Denpasar', 'Ubud', 'Badung', 'Gianyar'],
                    'Nusa Tenggara Barat' => ['Mataram', 'Lombok', 'Sumbawa', 'NTB'],
                ];

                if (isset($maps[$location])) {
                    foreach ($maps[$location] as $city) {
                        $q->orWhere('alamat', 'like', "%{$city}%");
                    }
                }
            });
        }

        // Filter Rating
        if ($request->filled('rating')) {
            if ($request->rating == 'lt_4') {
                $query->where('rating', '>=', 1)->where('rating', '<', 4);
            } else {
                $query->where('rating', '>=', $request->rating);
            }
        }

        // [PERBAIKAN] Logika Sorting (Termasuk Rating Tertinggi)
        if ($request->sort == 'Terbaru') {
            $query->latest();
        } elseif ($request->sort == 'Terlama') {
            $query->oldest();
        } elseif ($request->sort == 'Rating Tertinggi') {
            $query->orderByDesc('rating');
        } elseif ($request->sort == 'Rating Terendah') {
            $query->orderBy('rating');
        } else {
            $query->latest();
        }

        $umkms = $query->paginate(12)->withQueryString();

        // Ambil ID UMKM yang difavoritkan oleh user yang sedang login
        $favoritedUmkmIds = [];
        if (auth()->check()) {
            $favoritedUmkmIds = auth()->user()->favorites()->pluck('umkm_id')->toArray();
        }

        return view('kategori_detail', [
            'umkms' => $umkms,
            'category' => $slug,
            'favoritedUmkmIds' => $favoritedUmkmIds
        ]);
    }
}