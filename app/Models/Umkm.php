<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\UmkmVisit;

class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'umkm'; // Pastikan nama tabel di DB sesuai (umkms/umkm)

    protected $fillable = [
        'user_id',
        'nama_usaha',
        'kategori',
        'nama_pemilik',
        'tahun_berdiri',
        'deskripsi',
        'telepon',
        'email',
        'alamat',
        // Field Baru
        'maps_link',
        'jam_buka',
        'jam_tutup',
        // Status
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by',
        'rating',
        'total_reviews',
        'total_products',
        'total_sales',
        'slug',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rating' => 'decimal:2',
        'total_reviews' => 'integer',
        'total_products' => 'integer',
        'total_sales' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($umkm) {
            if (empty($umkm->slug)) {
                $umkm->slug = Str::slug($umkm->nama_usaha);
                $count = 1;
                while (static::where('slug', $umkm->slug)->exists()) {
                    $umkm->slug = Str::slug($umkm->nama_usaha) . '-' . $count;
                    $count++;
                }
            }
        });
    }

    // --- RELASI ---


    // Relasi ke Visits
    public function visits()
    {
        return $this->hasMany(UmkmVisit::class);
    }

    // Helper untuk ambil total kunjungan
    public function getTotalVisitsAttribute()
    {
        return $this->visits()->count();
    }

    // Helper untuk kunjungan bulan ini (untuk grafik/stats bulanan)
    public function getMonthlyVisitsAttribute()
    {
        return $this->visits()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function photos()
    {
        return $this->hasMany(UmkmPhoto::class, 'umkm_id');
    }

    // Relasi ke Menu
    public function menus()
    {
        return $this->hasMany(UmkmMenu::class, 'umkm_id');
    }

    public function primaryPhoto()
    {
        return $this->hasOne(UmkmPhoto::class, 'umkm_id')->where('is_primary', true);
    }

    /**
     * [PUNYA ANDA] Relasi ke Reviews
     * Mengambil ulasan terkait UMKM ini, diurutkan dari yang terbaru.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'umkm_id')->latest();
    }

    /**
     * [PUNYA TEMAN] Relationship: Umkm favorited by many Users
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'umkm_id', 'user_id')->withTimestamps();
    }

    // --- LOGIC / ACTIONS ---

    /**
     * [PUNYA ANDA] Hitung Ulang Rating
     * Fungsi ini dipanggil setiap kali ada review baru masuk atau dihapus.
     */
    public function refreshRating()
    {
        // 1. Hitung rata-rata dari tabel reviews
        $avg = $this->reviews()->avg('rating');

        // 2. Hitung jumlah total ulasan
        $count = $this->reviews()->count();

        // 3. Update kolom di tabel umkm
        $this->update([
            'rating' => $avg ? number_format($avg, 1) : 0,
            'total_reviews' => $count
        ]);
    }

    // --- SCOPES & HELPERS ---

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getWhatsappLinkAttribute(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->telepon);
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }
        return 'https://wa.me/' . $number;
    }
}
