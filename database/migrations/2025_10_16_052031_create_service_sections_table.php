<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('service_sections', function (Blueprint $t) {
      $t->id();
      $t->string('title');              // e.g. Digital Marketing
      $t->boolean('is_enabled')->default(true);
      $t->integer('sort_order')->default(0);
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('service_sections');
  }
};
