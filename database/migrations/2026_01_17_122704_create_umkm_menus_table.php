<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Buat Tabel Menu (umkm_menus) jika belum ada
        if (!Schema::hasTable('umkm_menus')) {
            Schema::create('umkm_menus', function (Blueprint $table) {
                $table->id();
                // Hubungkan ke tabel 'umkm' (tunggal) sesuai database temanmu
                $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
                $table->string('name');
                $table->decimal('price', 15, 2);
                $table->text('description')->nullable();
                $table->string('photo_path')->nullable();
                $table->timestamps();
            });
        }

        // 2. Tambahkan kolom baru ke tabel 'umkm' (jika belum ada)
        Schema::table('umkm', function (Blueprint $table) {
            if (!Schema::hasColumn('umkm', 'maps_link')) {
                $table->text('maps_link')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('umkm', 'jam_buka')) {
                $table->time('jam_buka')->nullable()->after('maps_link');
            }
            if (!Schema::hasColumn('umkm', 'jam_tutup')) {
                $table->time('jam_tutup')->nullable()->after('jam_buka');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('umkm_menus');
        
        if (Schema::hasTable('umkm')) {
            Schema::table('umkm', function (Blueprint $table) {
                $table->dropColumn(['maps_link', 'jam_buka', 'jam_tutup']);
            });
        }
    }
};