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
    Schema::create('driver_vehicles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('vehicle_number')->unique();
    $table->date('registration_date');
    $table->string('vehicle_type');
    $table->string('fuel_type');
    $table->string('vehicle_color');
    $table->integer('seat_count');
    $table->boolean('has_carrier')->default(false);
    $table->timestamps();
    $table->softDeletes(); // Optional, only if using SoftDeletes in model
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_vehicles');
    }
};
