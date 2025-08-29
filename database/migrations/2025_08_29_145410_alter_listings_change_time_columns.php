<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            // tukar column sedia ada jadi TIME
            $table->time('start_time')->change();
            $table->time('end_time')->change();
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            // fallback balik ke DATETIME kalau rollback
            $table->dateTime('start_time')->change();
            $table->dateTime('end_time')->change();
        });
    }
};
