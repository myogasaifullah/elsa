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
        Schema::create('persentase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_progres')->constrained('progress')->onDelete('cascade');
            $table->string('catatan1')->nullable();
            $table->string('catatan2')->nullable();
            $table->string('catatan3')->nullable();
            $table->string('catatan4')->nullable();
            $table->string('catatan5')->nullable();
            $table->string('catatan6')->nullable();
            $table->string('catatan7')->nullable();
            $table->string('catatan8')->nullable();
            $table->string('catatan9')->nullable();
            $table->string('catatan10')->nullable();
            $table->date('target_publish')->nullable();
            $table->string('publish_link_youtube')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->decimal('durasi_video_menit', 4, 2)->nullable();
            $table->decimal('persentase', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persentase');
    }
};
