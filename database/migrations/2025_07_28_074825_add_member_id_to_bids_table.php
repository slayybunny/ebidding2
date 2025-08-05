<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Semak jika kolum 'member_id' sudah ada
        if (!Schema::hasColumn('bids', 'member_id')) {
            // Jika kolum 'member_id' tidak wujud, tambah kolum tersebut terlebih dahulu
            Schema::table('bids', function (Blueprint $table) {
                $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            });
        } else {
            // Jika kolum 'member_id' sudah ada, hanya tambah foreign key constraint
            Schema::table('bids', function (Blueprint $table) {
                $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->dropColumn('member_id');
        });
    }
};
