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

        // Untuk filter melalui Search Bar 
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


        // Untuk filter kategori
        if ($request->has('categories')) {
            $query->whereIn('kategori', $request->categories);
        }

        // Untuk filter lokasi (filter jarak terdekat dari lokasi buyer belum)
        if ($request->filled('location') && $request->location != 'Semua Lokasi') {
            $query->where('alamat', 'like', "%{$request->location}%");
        }

        // Untuk filter sorting 
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

    public function direktori(Request $request)
    {
        // Logika mirip dengan 'jelajah', tapi mungkin tampilannya beda (List View / Grid View khusus UMKM)
        // Untuk sementara, kita bisa reuse view 'jelajah' atau buat view baru 'umkm.index'

        $query = \App\Models\Umkm::where('status', 'approved');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where('nama_usaha', 'LIKE', "%{$search}%")
                ->orWhere('deskripsi', 'LIKE', "%{$search}%");
        }

        $umkms = $query->paginate(12);

        // Kamu bisa buat view baru: resources/views/pages/umkm/index.blade.php
        // Atau sementara pakai view jelajah
        return view('jelajah', compact('umkms'));
    }

    public function category(Request $request, $slug)
    {
        $category = $slug;
        $query = Umkm::query()->with(['photos', 'menus']);

        // Filter berdasarkan kategori dari URL
        $query->where('kategori', $category);

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
            $query->where('alamat', 'like', "%{$request->location}%");
        }

        // Sorting
        if ($request->sort == 'Terbaru') {
            $query->latest();
        } elseif ($request->sort == 'Terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $umkms = $query->paginate(9)->withQueryString();

        return view('kategori_detail', compact('umkms', 'category'));
    }
}
