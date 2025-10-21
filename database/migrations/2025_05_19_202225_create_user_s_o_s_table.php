<?php

// database/migrations/xxxx_xx_xx_create_user_s_o_s_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSOSTable extends Migration
{
    public function up()
    {
        Schema::create('user_s_o_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ride_id');
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ride_id')->references('id')->on('ride_bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_s_o_s');
    }
}
