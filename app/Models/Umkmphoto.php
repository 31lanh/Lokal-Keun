<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UmkmPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'photo_path',
        'photo_url',
        'is_primary',
        'order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Relationship dengan UMKM
     */
    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    /**
     * Get full URL for photo
     */
    public function getUrlAttribute(): string
    {
        return $this->photo_url;
    }

    /**
     * Delete photo file when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            // Delete physical file
            if (Storage::disk('public')->exists($photo->photo_path)) {
                Storage::disk('public')->delete($photo->photo_path);
            }
        });
    }

    /**
     * Set as primary photo
     */
    public function setAsPrimary()
    {
        // Remove primary from other photos
        static::where('umkm_id', $this->umkm_id)
            ->update(['is_primary' => false]);

        // Set this as primary
        $this->update(['is_primary' => true]);
    }
}
