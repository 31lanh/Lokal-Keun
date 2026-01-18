<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',                 // Pastikan ini ada
        'profile_photo_path',   // <--- TAMBAHKAN BARIS INI
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah pembeli
     */
    public function isPembeli(): bool
    {
        return $this->role === 'pembeli';
    }

    /**
     * Cek apakah user adalah penjual
     */
    public function isPenjual(): bool
    {
        return $this->role === 'penjual';
    }

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Relationship dengan UMKM (untuk penjual)
     */
    public function umkm()
    {
        return $this->hasOne(Umkm::class);
    }

    /**
     * Check if user has completed UMKM registration
     */
    public function hasCompletedUmkmRegistration(): bool
    {
        return $this->isPenjual() && $this->umkm()->exists();
    }

    /**
     * Get formatted WhatsApp number
     */
    public function getFormattedWhatsappAttribute(): string
    {
        if (!$this->whatsapp) {
            return '';
        }

        // Format nomor WhatsApp untuk link
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);

        // Ubah 08 menjadi 628
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        return $number;
    }

    /**
     * Get WhatsApp chat link
     */
    public function getWhatsappLinkAttribute(): string
    {
        if (!$this->formatted_whatsapp) {
            return '';
        }

        return 'https://wa.me/' . $this->formatted_whatsapp;
    }

    /**
     * Get redirect route berdasarkan role
     */
    public function getRedirectRoute(): string
    {
        return match ($this->role) {
            'admin' => 'admin.dashboard',
            'penjual' => 'seller.daftar', // Penjual ke form daftar UMKM
            'pembeli' => 'home', // Pembeli ke home
            default => 'home',
        };
    }
}
