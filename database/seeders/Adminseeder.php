<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed admin account
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin Lokal-keun',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'), // GANTI PASSWORD INI DI PRODUCTION!
                'role' => 'admin',
                'whatsapp' => '081234567890',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin account created successfully!');
            $this->command->info('Email: admin@lokalkeun.com');
            $this->command->info('Password: admin123');
            $this->command->warn('IMPORTANT: Change this password in production!');
        } else {
            $this->command->info('Admin account already exists.');
        }
    }
}
