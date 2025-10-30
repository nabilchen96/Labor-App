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
        Schema::create('jadwal_labs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratorium_id')->constrained()->onDelete('cascade');
            $table->foreignId('id_user_1')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_user_2')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_user_3')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_user_4')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_user_5')->nullable()->constrained('users')->nullOnDelete();
            $table->string('hari');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_labs');
    }
};
