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
        Schema::table('listings', function (Blueprint $table) {
            // Tukar column status jadi ENUM dengan value yang sesuai
            $table->enum('status', ['PENDING', 'ONGOING', 'ENDED'])
                  ->default('PENDING')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            // Kalau nak rollback, contoh jadikan balik string
            $table->string('status')->change();
        });
    }
};
