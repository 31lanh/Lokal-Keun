<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade'); // Pastikan nama tabel umkm sesuai (umkm/umkms)
            $table->timestamps();

            // Mencegah duplikasi (satu user hanya bisa favorite satu UMKM sekali)
            $table->unique(['user_id', 'umkm_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};