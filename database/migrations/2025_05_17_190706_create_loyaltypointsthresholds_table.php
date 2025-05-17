<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('LoyaltyPointsThresholds', function (Blueprint $table) {
      $table->id('ID');
      $table->string('ThresholdName')->unique();
      $table->integer('MinAmount')->default(0);
      $table->integer('MaxAmount')->default(0);
      $table->integer('LoyaltyPointsPercentile')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('loyaltypointsthresholds');
  }
};
