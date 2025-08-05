<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->enum('category', ['WARGANEGARA MALAYSIA', 'BUKAN WARGANEGARA']);
        $table->string('name');
        $table->string('phone', 14);
        $table->string('address', 255)->nullable();
        $table->string('photo', 255)->nullable();
        $table->string('mykad', 12)->nullable()->unique();
        $table->string('passport', 9)->nullable()->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
        $table->string('otp')->nullable();
        $table->timestamp('otp_expires_at')->nullable();
        $table->string('new_phone', 255)->nullable();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
