<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('PaymentInfos', function (Blueprint $table) {
      $table->id('PaymentID');
      $table->unsignedBigInteger('BookingDetailID');
      $table->decimal('TotalAmount', 20, 2);
      $table->enum('PaymentStatus', ['Pending', 'Completed', 'Failed'])->default('Pending');
      $table->string('PaymentMethod')->default(null);
      $table->timestamps();

      $table->foreign('BookingDetailID')->references('BookingDetailID')->on('BookingDetails')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('paymentinfos');
  }
};
