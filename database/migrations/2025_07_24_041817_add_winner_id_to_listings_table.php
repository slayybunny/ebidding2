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
    Schema::table('listings', function (Blueprint $table) {
        $table->unsignedBigInteger('winner_id')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('listings', function (Blueprint $table) {
        $table->dropColumn('winner_id');
    });
}

};
