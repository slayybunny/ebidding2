<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Membuang foreign key constraint dari 'user_id'
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign('bids_user_id_foreign');  // Drop foreign key constraint berdasarkan nama foreign key
        });

        // Membuang kolum 'user_id'
        Schema::table('bids', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        // Menambah foreign key constraint pada 'member_id'
        Schema::table('bids', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Jika migrasi perlu dibatalkan, kembalikan semula foreign key dan kolum 'user_id'
        Schema::table('bids', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }
};
