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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('member_id'); // Correct the column name to member_id
            $table->decimal('bid_price', 10, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade'); // Fixed the reference to member_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
};
