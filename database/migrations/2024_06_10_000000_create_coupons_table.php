<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['fixed', 'percentage']);
            $table->decimal('amount', 10, 2);
            $table->string('coupon_code')->unique();
            $table->date('validity');
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}; 