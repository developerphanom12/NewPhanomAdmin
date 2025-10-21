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
        Schema::create('intra_city_costings', function (Blueprint $table) {
            $table->id();
            
            // Moto (Bike)
            $table->decimal('basic_amount_moto', 10, 2);
            $table->decimal('per_km_price_moto', 10, 2);
            $table->enum('kabby_shares_moto', ['percentage', 'fixed']);
            $table->decimal('kabby_amount_moto', 10, 2);
            
            // Mini (Alto/Wagon R)
            $table->decimal('basic_amount_mini', 10, 2);
            $table->decimal('per_km_price_mini', 10, 2);
            $table->enum('kabby_shares_mini', ['percentage', 'fixed']);
            $table->decimal('kabby_amount_mini', 10, 2);
            
            // Sedan
            $table->decimal('basic_amount_sedan', 10, 2);
            $table->decimal('per_km_price_sedan', 10, 2);
            $table->enum('kabby_shares_sedan', ['percentage', 'fixed']);
            $table->decimal('kabby_amount_sedan', 10, 2);
            
            // Ertiga
            $table->decimal('basic_amount_ertiga', 10, 2);
            $table->decimal('per_km_price_ertiga', 10, 2);
            $table->enum('kabby_shares_ertiga', ['percentage', 'fixed']);
            $table->decimal('kabby_amount_ertiga', 10, 2);
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intra_city_costings');
    }
};
