<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'umkm_id', 'rating', 'comment'];

    // Relasi: Review milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Review milik UMKM
    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}