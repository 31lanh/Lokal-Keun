<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Support\Str;

Route::get('/debug-transaction', function () {
    DB::enableQueryLog();
    try {
        echo "<h1>Debug Raw SQL & Transaction</h1>";

        // TEST 1: Users Table (Control Group)
        echo "<h3>Test 1: User Table Insert (Transaction)</h3>";
        DB::beginTransaction();
        try {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Debug Temp User',
                'email' => 'debug-temp-' . time() . '@example.com',
                'password' => 'secret',
                'role' => 'pembeli',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "User Insert Success! ID: " . $userId . "<br>";
            DB::rollBack(); // Rollback control
            echo "User Transaction Rolled Back.<br>";
        } catch (\Exception $e) {
            echo "<strong>User Test FAILED:</strong> " . $e->getMessage() . "<br>";
            DB::rollBack();
        }

        // TEST 2: UMKM Table (Experimental Group)
        echo "<h3>Test 2: UMKM Table Insert (Transaction)</h3>";
        DB::beginTransaction(); // Start fresh transaction
        try {
            // Raw Insert
            $umkmId = DB::table('umkm')->insertGetId([
                'user_id' => 1,
                'nama_usaha' => 'Raw Transaction Debug',
                'kategori' => 'kuliner',
                'nama_pemilik' => 'Debug',
                'tahun_berdiri' => 2024,
                'deskripsi' => 'Debug...',
                'telepon' => '08123456789',
                'email' => 'debug-raw@example.com',
                'alamat' => 'Debug',
                'status' => 'pending',
                'slug' => 'raw-trx-debug-' . time(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "UMKM Insert Success! ID: " . $umkmId . "<br>";
            DB::rollBack();
            echo "UMKM Transaction Rolled Back.<br>";
        } catch (\Exception $e) {
            echo "<strong>UMKM Test FAILED:</strong> " . $e->getMessage() . "<br>";
            echo "SQL State: " . $e->getCode() . "<br>";
            DB::rollBack();
        }

        echo "<h3>Query Log</h3>";
        echo "<pre>" . print_r(DB::getQueryLog(), true) . "</pre>";

    } catch (\Exception $e) {
        echo "Global Error: " . $e->getMessage();
    }
});
