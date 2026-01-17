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
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}