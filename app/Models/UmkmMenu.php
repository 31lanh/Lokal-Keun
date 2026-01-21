<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmMenu extends Model
{
    use HasFactory;

    protected $table = 'umkm_menus';

    protected $fillable = [
        'umkm_id',
        'name',
        'price',
        'description',
        'photo_path',
        'is_recommended', // [BARU] Tambahkan ini
    ];

    protected $casts = [
        'is_recommended' => 'boolean', // [BARU] Casting ke boolean
        'price' => 'integer',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id');
    }
}