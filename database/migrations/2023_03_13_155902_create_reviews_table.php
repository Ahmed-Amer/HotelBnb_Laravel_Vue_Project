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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedTinyInteger('rating');
            $table->text('content');
            $table->unsignedBigInteger('bookable_id')->index();
            $table->unsignedBigInteger('booking_id')->index()->nullable();
            $table->timestamps();

            $table->foreign('bookable_id')->references('id')->on('bookables');
            $table->foreign('booking_id')->references('id')->on('bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_bookable_id_foreign');
            $table->dropForeign('reviews_booking_id_foreign');
        });
        Schema::dropIfExists('reviews');
    }
};
