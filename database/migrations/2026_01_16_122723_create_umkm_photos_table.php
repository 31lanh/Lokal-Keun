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
        Schema::create('umkm_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->string('photo_path');
            $table->string('photo_url'); // Full URL untuk akses
            $table->boolean('is_primary')->default(false); // Foto utama
            $table->integer('order')->default(0); // Urutan tampilan
            $table->timestamps();

            // Indexes
            $table->index('umkm_id');
            $table->index(['umkm_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_photos');
    }
};
