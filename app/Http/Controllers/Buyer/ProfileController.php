<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name'      => 'required|string|max:255',
            'whatsapp'  => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:500',
            'map_link'  => 'nullable|url',
        ]);

        // 2. Ambil User yang sedang login
        $user = Auth::user();

        // 3. Update data text
        $user->name     = $request->name;
        $user->whatsapp = $request->whatsapp;
        $user->address  = $request->address;
        $user->map_link = $request->map_link;

        // 5. Simpan ke Database
        $user->save();

        // 6. Kembali dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}