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
    Schema::table('login_logs', function (Blueprint $table) {
        $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('login_logs', function (Blueprint $table) {
        $table->dropForeign(['admin_id']);
    });
}

};
