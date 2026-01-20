<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;

class BuyerController extends Controller
{
    public function index()
    {
        // Tampilkan halaman welcome (landing page)
        return app(PublicController::class)->welcome();
    }

    public function toggleFavorite($id)
    {
        $umkm = Umkm::findOrFail($id);
        $user = auth()->user();

        // Cek apakah sudah ada di favorit
        if ($user->favorites()->where('umkm_id', $id)->exists()) {
            // Jika ada, hapus (unfavorite)
            $user->favorites()->detach($id);
            $status = 'removed';
        } else {
            // Jika belum, tambahkan (favorite)
            $user->favorites()->attach($id);
            $status = 'added';
        }

        return response()->json(['status' => $status, 'message' => 'Berhasil diperbarui']);
    }
}
