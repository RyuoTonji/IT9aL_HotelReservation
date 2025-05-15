<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Services', function (Blueprint $table) {
      $table->id('ServiceID');
      $table->string('ServiceName')->unique();
      $table->text('ServiceDescription')->nullable();
      $table->decimal('ServicePrice', 20, 2);
      $table->enum('ServiceStatus', ['Available', 'Unavailable'])->default('Available');
      $table->string('ImagePathname')->nullable();
      $table->string('ImageName')->nullable();
      $table->string('MimeType')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('services');
  }
};
