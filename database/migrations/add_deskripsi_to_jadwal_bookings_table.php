<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_bookings', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('nama_mata_kuliah');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_bookings', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
