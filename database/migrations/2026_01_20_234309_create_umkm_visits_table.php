<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('umkm_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->string('ip_address')->nullable(); // Untuk mencegah spam view dari IP yang sama
            $table->string('user_agent')->nullable(); // Info browser/device
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Jika user login
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_visits');
    }
};
