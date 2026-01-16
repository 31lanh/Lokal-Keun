<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Seed seller account
     */
    public function run(): void
    {
        if (!User::where('email', 'penjual@example.com')->exists()) {
            User::create([
                'name' => 'Penjual Demo',
                'email' => 'penjual@example.com',
                'password' => Hash::make('penjual123'),
                'role' => 'penjual',
                'whatsapp' => '082222222222',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Seller account created successfully!');
            $this->command->info('Email: penjual@example.com');
            $this->command->info('Password: penjual123');
        } else {
            $this->command->info('Seller account already exists.');
        }
    }
}
