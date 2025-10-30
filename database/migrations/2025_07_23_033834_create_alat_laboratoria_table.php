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
        Schema::create('alat_laboratoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id')->constrained()->onDelete('cascade');
            $table->string('nama_alat');
            $table->string('tipe');
            $table->string('gambar')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_laboratoria');
    }
};
