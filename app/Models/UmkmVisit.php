<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmVisit extends Model
{
    use HasFactory;

    protected $fillable = ['umkm_id', 'ip_address', 'user_agent', 'user_id'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
