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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Informasi Dasar
            $table->string('nama_usaha');
            $table->enum('kategori', ['kuliner', 'fashion', 'kerajinan', 'pertanian', 'jasa']);
            $table->string('nama_pemilik');
            $table->year('tahun_berdiri')->nullable();

            // Deskripsi
            $table->text('deskripsi');

            // Kontak & Lokasi
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->text('alamat');

            // Status & Verifikasi
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            // Rating & Statistics
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_products')->default(0);
            $table->integer('total_sales')->default(0);

            // SEO & Slug
            $table->string('slug')->unique();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('user_id');
            $table->index('kategori');
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
