<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('bookingdetails', function (Blueprint $table) {
      $table->id('BookingDetailID');
      $table->unsignedBigInteger('UserID');
      $table->unsignedBigInteger('RoomID');
      $table->dateTime('CheckInDate');
      $table->dateTime('CheckOutDate');
      $table->integer('NumberOfGuests');
      // $table->decimal('SubTotal', 8, 2);
      $table->enum('BookingStatus', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
      $table->timestamps();

      $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('RoomID')->references('RoomID')->on('rooms')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('bookingdetails');
  }
};
