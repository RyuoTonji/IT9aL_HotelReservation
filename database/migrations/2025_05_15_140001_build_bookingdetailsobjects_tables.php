<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('BookingDetails', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('UserID')->constrained('Users', 'ID')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('RoomTypeID')->constrained('RoomTypes', 'ID')->onDelete('cascade')->onUpdate('cascade');
      $table->dateTime('CheckInDate');
      $table->dateTime('CheckOutDate');
      $table->integer('NumberOfGuests');
      $table->foreignId('RoomSize')->constrained('RoomSizeTypes', 'ID')->onDelete('cascade')->onUpdate('cascade');
      $table->enum('BookingStatus', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
      $table->timestamps();
    });

    Schema::create('ServicesAdded', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('BookingDetailID')->constrained('BookingDetails', 'ID')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('ServiceID')->constrained('Services', 'ID')->onDelete('cascade')->onUpdate('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('BookingDetails');
    Schema::dropIfExists('ServicesAdded');
  }
};
