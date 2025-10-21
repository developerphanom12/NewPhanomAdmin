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
        Schema::table('driver_licenses', function (Blueprint $table) {
            if (Schema::hasColumn('driver_licenses', 'expiry_date')) {
                $table->dropColumn('expiry_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driver_licenses', function (Blueprint $table) {
            if (!Schema::hasColumn('driver_licenses', 'expiry_date')) {
                $table->date('expiry_date')->nullable()->after('front_image_path');
            }
        });
    }
}; 