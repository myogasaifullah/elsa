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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->nullOnDelete();
            $table->foreign('prodi_id')->references('id')->on('prodis')->nullOnDelete();
        });

        Schema::table('prodis', function (Blueprint $table) {
            $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['fakultas_id']);
            $table->dropForeign(['prodi_id']);
        });

        Schema::table('prodis', function (Blueprint $table) {
            $table->dropForeign(['fakultas_id']);
        });
    }
};
