<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRideDriverTable extends Migration
{
    public function up()
    {
        Schema::create('ride_driver', function (Blueprint $table) {
            $table->id();

            // Ensure type matches 'rides.id' and 'users.id'
            $table->unsignedBigInteger('ride_id');
            $table->unsignedBigInteger('driver_id');

            $table->timestamps();

            // Add foreign keys
            $table->foreign('ride_id')->references('id')->on('ride_bookings')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ride_driver');
    }
}
