<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('Rooms', function (Blueprint $table) {
      $table->id('ID');
      $table->string('RoomName')->unique();
      $table->text('RoomDescription')->nullable();
      $table->enum('RoomType', ['Standard', 'Executive', 'Deluxe'])->default('Standard');
      $table->integer('RoomCapacity')->default(1);
      $table->decimal('RoomPrice', 20, 2);
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
    Schema::dropIfExists('Rooms');
  }
};
