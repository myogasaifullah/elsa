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
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->string('kode_matakuliah')->after('nama_mata_kuliah');
            $table->integer('sks')->after('kode_matakuliah');
            $table->enum('keterangan', ['wajib', 'pilihan'])->after('sks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mata_kuliahs', function (Blueprint $table) {
            $table->dropColumn(['kode_matakuliah', 'sks', 'keterangan']);
        });
    }
};
