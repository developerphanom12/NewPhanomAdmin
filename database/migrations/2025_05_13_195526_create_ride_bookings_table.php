<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ride_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('users') // make sure it references users table
                ->onDelete('cascade');

            $table->string('vehicle_type');
            $table->string('boarding_point');
            $table->string('destination_point');
            $table->boolean('carrier_required')->default(false);
            $table->string('alternate_contact')->nullable(); // for someone else taking the ride
            $table->boolean('ac_required')->default(false);

            $table->decimal('booking_amount', 8, 2);
            $table->decimal('commission', 8, 2);
            $table->decimal('total_driver_payment', 8, 2);

            $table->unsignedTinyInteger('ride_status')->default(0); // 0,1,2,3,4
            $table->unsignedInteger('distance'); // in kilometers/meters
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->enum('payment_method', ['wallet', 'razorpay']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ride_bookings');
    }
};
