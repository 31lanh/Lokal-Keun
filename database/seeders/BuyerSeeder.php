<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BuyerSeeder extends Seeder
{
    /**
     * Seed buyer account
     */
    public function run(): void
    {
        if (!User::where('email', 'pembeli@example.com')->exists()) {
            User::create([
                'name' => 'Pembeli Demo',
                'email' => 'pembeli@example.com',
                'password' => Hash::make('pembeli123'),
                'role' => 'pembeli',
                'whatsapp' => '081111111111',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Buyer account created successfully!');
            $this->command->info('Email: pembeli@example.com');
            $this->command->info('Password: pembeli123');
        } else {
            $this->command->info('Buyer account already exists.');
        }
    }
}
