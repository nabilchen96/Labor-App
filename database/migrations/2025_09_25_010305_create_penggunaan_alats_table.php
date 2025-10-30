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
        Schema::create('penggunaan_alats', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('peminjaman_id');
            $table->string('user_nama'); // ganti dari user_id jadi text
            $table->unsignedBigInteger('alat_id');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->text('kondisi_awal')->nullable();
            $table->text('kondisi_akhir')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('id')->on('peminjamen')->onDelete('cascade');
            $table->foreign('alat_id')->references('id')->on('alat_laboratoria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_alats');
    }
};
