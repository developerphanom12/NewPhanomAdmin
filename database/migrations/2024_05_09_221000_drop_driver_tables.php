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
        Schema::dropIfExists('documents');
        Schema::dropIfExists('driver_details');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We're not recreating these tables in the down method
        // as they would require specific schemas that were defined
        // in the deleted migrations
    }
}; 