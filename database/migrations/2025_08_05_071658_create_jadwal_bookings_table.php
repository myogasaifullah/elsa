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
        Schema::create('jadwal_bookings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('jenis_kategori');
            $table->string('kategori_mooc')->nullable();
            $table->string('studio');
            $table->string('nama_mata_kuliah');
            $table->string('judul_course');
            $table->string('status')->default('pending');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_bookings');
    }
};
