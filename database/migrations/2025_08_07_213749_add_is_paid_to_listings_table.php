<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     /**public function up()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->boolean('is_paid')->default(false);
    });
}

public function down()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->dropColumn('is_paid');
    });
}*/

};
