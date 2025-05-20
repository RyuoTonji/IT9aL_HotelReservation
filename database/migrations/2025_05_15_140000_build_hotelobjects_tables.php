<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('RoomSizes', function (Blueprint $table) {
      $table->id('ID');
      $table->string('RoomSizeName')->unique();
      $table->text('RoomSizeDescription')->nullable();
      $table->integer('RoomCapacity');
      $table->decimal('PricePerPerson', 20, 2);
      $table->decimal('RoomSizePrice', 20, 2);
      $table->timestamps();
    });

    Schema::create('RoomTypes', function (Blueprint $table) {
      $table->id('ID');
      $table->string('RoomTypeName')->unique();
      $table->text('RoomDescription')->nullable();
      $table->integer('RoomCapacity')->default(1);
      $table->decimal('RoomPrice', 20, 2);
      $table->decimal('SucceedingNights', 20, 2);
      $table->string('ImagePathname')->nullable();
      $table->string('ImageName')->nullable();
      $table->string('MimeType')->nullable();
      $table->timestamps();
    });

    Schema::create('Services', function (Blueprint $table) {
      $table->id('ID');
      $table->string('ServiceName')->unique();
      $table->text('ServiceDescription')->nullable();
      $table->decimal('ServicePrice', 20, 2);
      $table->enum('ServiceStatus', ['Available', 'Unavailable'])->default('Available');
      $table->string('ImagePathname')->nullable();
      $table->string('ImageName')->nullable();
      $table->string('MimeType')->nullable();
      $table->timestamps();
    });

    Schema::create('CashbackThresholds', function (Blueprint $table) {
      $table->id('ID');
      $table->string('ThresholdName')->unique();
      $table->string('ThresholdDescription')->nullable();
      $table->decimal('MinPaidAmount', 20, 2)->default(0);
      $table->decimal('CashbackPercentile', 20, 0)->default(0);
      $table->timestamps();
    });

    Schema::create('LoyaltyTiers', function (Blueprint $table) {
      $table->id('ID');
      $table->string('TierName')->unique();
      $table->string('TierDescription')->nullable();
      $table->integer('MinPoints')->default(0);
      $table->decimal('Discount', 20, 2)->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('RoomSizeTypes');
    Schema::dropIfExists('RoomTypes');
    Schema::dropIfExists('Services');
    Schema::dropIfExists('CashbackThresholds');
Schema::dropIfExists('LoyaltyTiers');

  }
};
