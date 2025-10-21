<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('boarding_point');
            $table->string('destination_point');
            $table->decimal('distance', 10, 2);
            $table->string('destination_range');
            
            // Commission
            $table->decimal('commission_alto', 10, 2);
            $table->decimal('commission_sedan', 10, 2);
            $table->decimal('commission_ertiga', 10, 2);
            
            // Total Fare
            $table->decimal('total_fare_alto', 10, 2);
            $table->decimal('total_fare_sedan', 10, 2);
            $table->decimal('total_fare_ertiga', 10, 2);
            
            // Driver Fare
            $table->decimal('driver_fare_alto', 10, 2);
            $table->decimal('driver_fare_sedan', 10, 2);
            $table->decimal('driver_fare_ertiga', 10, 2);
            
            // Minimum Booking Amount
            $table->decimal('min_booking_alto', 10, 2);
            $table->decimal('min_booking_sedan', 10, 2);
            $table->decimal('min_booking_ertiga', 10, 2);
            
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
}; 