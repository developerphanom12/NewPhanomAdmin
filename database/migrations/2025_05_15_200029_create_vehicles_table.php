<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->unique();
            $table->string('vehicle_number');
            $table->date('registration_date');
            $table->string('vehicle_type');
            $table->string('fuel_type')->nullable();
            $table->string('has_carrier')->nullable();
            $table->string('vehicle_color');
            $table->string('seats');
            $table->json('accepted_rules');
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
