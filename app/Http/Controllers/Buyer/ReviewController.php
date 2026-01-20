<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Umkm;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Simpan Ulasan
    public function store(Request $request, $umkmId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $umkm = Umkm::findOrFail($umkmId);

        // Cek apakah user sudah pernah review UMKM ini? (Opsional, agar 1 user 1 review)
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('umkm_id', $umkm->id)
                                ->first();

        if ($existingReview) {
            // Update review lama jika sudah ada
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);
        } else {
            // Buat review baru
            Review::create([
                'user_id' => auth()->id(),
                'umkm_id' => $umkm->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
        }

        // Update rata-rata rating di tabel UMKM
        $umkm->refreshRating();

        // Redirect kembali ke tab reviews
        return back()->with('success', 'Ulasan berhasil dikirim!')
                     ->with('active_tab', 'reviews'); // Trigger untuk buka tab reviews
    }

    // Hapus Ulasan
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Pastikan yang menghapus adalah pemilik ulasan
        if (auth()->id() !== $review->user_id) {
            return back()->with('error', 'Anda tidak berhak menghapus ulasan ini.');
        }

        $umkm = $review->umkm;
        $review->delete();

        // Hitung ulang rating
        $umkm->refreshRating();

        return back()->with('success', 'Ulasan berhasil dihapus.')
                     ->with('active_tab', 'reviews');
    }
}