<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Cuba cari nama foreign key untuk user_id secara manual dari MySQL
        $foreignKeyName = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'bids'
            AND COLUMN_NAME = 'user_id'
            AND CONSTRAINT_SCHEMA = DATABASE()
            LIMIT 1
        ");

        Schema::table('bids', function (Blueprint $table) use ($foreignKeyName) {
            if ($foreignKeyName) {
                $table->dropForeign($foreignKeyName->CONSTRAINT_NAME);
            }
            if (Schema::hasColumn('bids', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (!Schema::hasColumn('bids', 'member_id')) {
                $table->unsignedBigInteger('member_id');
                $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        // Reverse changes
        $foreignKeyName = DB::selectOne("
            SELECT CONSTRAINT_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = 'bids'
            AND COLUMN_NAME = 'member_id'
            AND CONSTRAINT_SCHEMA = DATABASE()
            LIMIT 1
        ");

        Schema::table('bids', function (Blueprint $table) use ($foreignKeyName) {
            if ($foreignKeyName) {
                $table->dropForeign($foreignKeyName->CONSTRAINT_NAME);
            }
            if (Schema::hasColumn('bids', 'member_id')) {
                $table->dropColumn('member_id');
            }
            if (!Schema::hasColumn('bids', 'user_id')) {
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
};
