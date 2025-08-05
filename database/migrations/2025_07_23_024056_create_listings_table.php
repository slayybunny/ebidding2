<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // foreign key to 'members' table
            $table->string('item', 100);
            $table->string('type', 100);
            $table->decimal('price', 10, 2);
            $table->decimal('starting_price', 10, 2);
            $table->decimal('bidding_price', 10, 2)->nullable();
            $table->date('date');

            // Store total duration in minutes
            $table->unsignedInteger('duration')->default(0);

            $table->enum('status', ['active', 'unactive'])->default('unactive');
            $table->string('currency')->default('MYR');
            $table->text('info');
            $table->string('image')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
        });

        Schema::dropIfExists('listings');
    }
};
