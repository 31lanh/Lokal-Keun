<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/debug-schema-deep', function () {
    try {
        echo "<h1>Deep Schema Debug</h1>";
        
        // 1. Check Triggers on UMKM
        echo "<h3>1. Triggers on 'umkm' table</h3>";
        $triggers = DB::select("
            SELECT trigger_name, event_manipulation, action_statement 
            FROM information_schema.triggers 
            WHERE event_object_table = 'umkm'
        ");
        
        if (empty($triggers)) {
            echo "No triggers found on 'umkm'.<br>";
        } else {
            echo "<pre>" . json_encode($triggers, JSON_PRETTY_PRINT) . "</pre>";
        }

        // 2. Check Triggers on Users (just in case)
        echo "<h3>2. Triggers on 'users' table</h3>";
        $triggersUser = DB::select("
            SELECT trigger_name, event_manipulation, action_statement 
            FROM information_schema.triggers 
            WHERE event_object_table = 'users'
        ");

         if (empty($triggersUser)) {
            echo "No triggers found on 'users'.<br>";
        } else {
            echo "<pre>" . json_encode($triggersUser, JSON_PRETTY_PRINT) . "</pre>";
        }

        // 3. Check Sequence State for UMKM
        echo "<h3>3. Sequence Status</h3>";
        try {
             $seq = DB::select("SELECT last_value FROM umkm_id_seq");
             echo "Current umkm_id_seq last_value: " . ($seq[0]->last_value ?? 'N/A') . "<br>";
        } catch (\Exception $e) {
            echo "Error checking sequence: " . $e->getMessage() . "<br>";
        }

        // 4. Test Transaction Rollback Cause
        echo "<h3>4. Testing Transaction Rollback Cause</h3>";
        DB::beginTransaction();
        try {
             // We will try to specifically just select, then insert, and print ANY error.
             // We want to know if the SELECT throws.
             
             echo "Running SELECT... ";
             $exists = DB::table('umkm')->where('slug', 'non-existent-slug-' . time())->exists();
             echo "SELECT result: " . ($exists ? 'Yes' : 'No') . "<br>";
             
             echo "Running INSERT... ";
             $id = DB::table('umkm')->insertGetId([
                'user_id' => 1, // Assume ID 1 exists
                'nama_usaha' => 'Debug Deep',
                'kategori' => 'kuliner',
                'nama_pemilik' => 'Debug',
                'tahun_berdiri' => 2024,
                'deskripsi' => 'Debug...',
                'telepon' => '08111111',
                'email' => 'debug-deep@example.com',
                'alamat' => 'Debug',
                'status' => 'pending',
                'slug' => 'debug-deep-' . time(),
                'created_at' => now(),
                'updated_at' => now(),
             ]);
             echo "INSERT success ID: " . $id . "<br>";
             
             DB::rollBack();
             echo "Transaction Rolled Back normally.<br>";
             
        } catch (\Exception $e) {
             // If we catch here, query failed.
             echo "<br><strong>Caught Exception:</strong> " . $e->getMessage() . "<br>";
             // Check transaction status?
             try {
                DB::rollBack();
             } catch (\Exception $ex) {
                 echo "Rollback failed (already aborted?): " . $ex->getMessage() . "<br>";
             }
        }

    } catch (\Exception $e) {
        echo "Global Error: " . $e->getMessage();
    }
});
