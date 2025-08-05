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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_booking_id')->constrained('jadwal_bookings')->onDelete('cascade');
            $table->date('target_upload')->nullable();
            $table->decimal('persentase', 5, 2)->default(0.00);
            $table->enum('progres', ['belum', 'progres', 'selesai'])->default('belum');
            $table->enum('keterangan', ['sudah terbit', 'belum terbit'])->default('belum terbit');
            $table->integer('durasi')->nullable();
            $table->date('tanggal_upload_youtube')->nullable();
            $table->foreignId('editor_id')->constrained('editors')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['jadwal_booking_id', 'progres']);
            $table->index(['editor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
