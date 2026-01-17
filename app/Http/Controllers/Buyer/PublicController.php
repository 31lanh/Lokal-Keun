<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {

    $query = Umkm::query()->with(['photos', 'menus']); 

    // --- LOGIKA PENCARIAN UTAMA ---
    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('nama_usaha', 'like', "%{$search}%")       
              ->orWhere('kategori', 'like', "%{$search}%")       
              ->orWhere('deskripsi', 'like', "%{$search}%")      
              ->orWhere('alamat', 'like', "%{$search}%")         
              ->orWhereHas('menus', function($qMenu) use ($search) {
                  $qMenu->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
              });
        });
    }

    // --- Filter Tambahan (Kategori Checkbox) ---
    if ($request->has('categories')) {
        $query->whereIn('kategori', $request->categories);
    }

    // --- Filter Lokasi ---
    if ($request->filled('location') && $request->location != 'Semua Lokasi') {
        $query->where('alamat', 'like', "%{$request->location}%");
    }

    // --- Sorting ---
    if ($request->sort == 'Terbaru') {
        $query->latest();
    } elseif ($request->sort == 'Terlama') {
        $query->oldest();
    } else {
        $query->latest();
    }

        $umkms = $query->with(['photos', 'menus'])
                       ->paginate(9)
                       ->withQueryString();

        return view('jelajah', compact('umkms'));
    }
}
