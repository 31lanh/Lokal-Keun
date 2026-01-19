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
        'is_primary', // Pastikan ini ada
        'order',
        'file_name',  // Opsional
        'file_size',  // Opsional
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}