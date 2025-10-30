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
        Schema::create('log_book_pengecekans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id')->constrained()->onDelete('cascade');
            $table->foreignId('alat_laboratorium_id')->constrained()->onDelete('cascade');
            $table->dateTime('waktu_pengecekan');
            $table->enum('kondisi', ['Baik', 'Rusak Berat', 'Rusak Ringan', 'Lainnya']);
            $table->text('keterangan')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('gambar_pengecekan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_book_pengecekans');
    }
};
