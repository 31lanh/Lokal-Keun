<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'umkm';

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

    /**
     * Boot method untuk auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($umkm) {
            if (empty($umkm->slug)) {
                $umkm->slug = Str::slug($umkm->nama_usaha);

                // Pastikan slug unik
                $count = 1;
                while (static::where('slug', $umkm->slug)->exists()) {
                    $umkm->slug = Str::slug($umkm->nama_usaha) . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Relationship dengan User (Pemilik)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan User yang approve
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relationship dengan Photos
     */
    public function photos()
    {
        return $this->hasMany(UmkmPhoto::class);
    }

    /**
     * Get primary/main photo
     */
    public function primaryPhoto()
    {
        return $this->hasOne(UmkmPhoto::class)->where('is_primary', true);
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope untuk filter by kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Check if UMKM is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if UMKM is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if UMKM is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve UMKM
     */
    public function approve($approvedBy = null)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => $approvedBy ?? auth()->id(),
            'rejection_reason' => null,
        ]);
    }

    /**
     * Reject UMKM
     */
    public function reject($reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }

    /**
     * Get kategori label
     */
    public function getKategoriLabelAttribute(): string
    {
        $labels = [
            'kuliner' => '🍜 Kuliner & Makanan',
            'fashion' => '👗 Fashion & Busana',
            'kerajinan' => '🎨 Kerajinan Tangan',
            'pertanian' => '🌾 Pertanian & Agrobisnis',
            'jasa' => '🛠️ Jasa & Layanan',
        ];

        return $labels[$this->kategori] ?? $this->kategori;
    }

    /**
     * Get route to UMKM detail page
     */
    public function getRouteAttribute(): string
    {
        return route('umkm.show', $this->slug);
    }

    /**
     * Get WhatsApp link
     */
    public function getWhatsappLinkAttribute(): string
    {
        $number = preg_replace('/[^0-9]/', '', $this->telepon);

        // Ubah 08 menjadi 628
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        return 'https://wa.me/' . $number;
    }
}
