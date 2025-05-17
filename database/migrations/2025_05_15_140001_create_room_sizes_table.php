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
      $table->integer('RoomSizeCapacity');
      $table->decimal('PricePerPerson', 20, 2);
      $table->decimal('RoomSizePrice', 20, 2);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('RoomSizes');
  }
};
