<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Umkm;

Route::get('/debug-data-check', function () {
    try {
        echo "<h1>Data Check for Latest UMKM</h1>";
        
        // Get Latest UMKM
        $umkm = Umkm::latest()->first();
        if (!$umkm) return "No UMKM found.";
        
        echo "<h3>UMKM Info</h3>";
        echo "ID: " . $umkm->id . "<br>";
        echo "Nama: " . $umkm->nama_usaha . "<br>";
        echo "Slug: " . $umkm->slug . "<br>";
        echo "Status: " . $umkm->status . "<br>";
        
        // Check Photos
        echo "<h3>Photos</h3>";
        $photos = DB::table('umkm_photos')->where('umkm_id', $umkm->id)->get();
        echo "Count: " . $photos->count() . "<br>";
        if ($photos->count() > 0) {
            echo "<pre>" . json_encode($photos, JSON_PRETTY_PRINT) . "</pre>";
        } else {
            echo "No photos found in DB.<br>";
        }

        // Check Menus
        echo "<h3>Menus</h3>";
        $menus = DB::table('umkm_menus')->where('umkm_id', $umkm->id)->get();
        echo "Count: " . $menus->count() . "<br>";
         if ($menus->count() > 0) {
            echo "<pre>" . json_encode($menus, JSON_PRETTY_PRINT) . "</pre>";
        } else {
            echo "No menus found in DB.<br>";
        }
        
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
});
