<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            if (!Schema::hasColumn('bids', 'member_id')) {
                $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            }

            if (Schema::hasColumn('bids', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            if (Schema::hasColumn('bids', 'member_id')) {
                $table->dropForeign(['member_id']);
                $table->dropColumn('member_id');
            }
            if (!Schema::hasColumn('bids', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            }
        });
    }
};
