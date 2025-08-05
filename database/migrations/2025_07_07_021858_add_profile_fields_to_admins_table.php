<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('admins', function (Blueprint $table) {
        $table->string('phone_number')->nullable();
        $table->string('admin_id')->unique()->nullable();
        $table->string('profile_picture')->nullable();
    });
}

public function down()
{
    Schema::table('admins', function (Blueprint $table) {
        $table->dropColumn(['phone_number', 'admin_id', 'profile_picture']);
    });
}
};
