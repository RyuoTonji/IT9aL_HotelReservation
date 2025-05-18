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
      $table->id('ID');
      $table->foreignId('BookingDetailID')->constrained('BookingDetails', 'ID')->onDelete('cascade');
      $table->decimal('TotalAmount', 20, 2);
      $table->enum('PaymentStatus', ['Pending', 'Completed', 'Failed'])->default('Pending');
      $table->enum('PaymentMethod', ['Cash', 'Card', 'GCash'])->default('Cash');
      $table->timestamps();
    });

    // Payment Type Tables
    Schema::create('paymenttype_cash', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->decimal('CashAmount', 20, 2);
      $table->timestamps();
    });

    Schema::create('paymenttype_card', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->string('Name');
      $table->string('CardNumber');
      $table->string('ExpiryDate', 5);
      $table->string('CVC', 4);
      $table->timestamps();
    });

    Schema::create('paymenttype_gcash', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->string('Name');
      $table->string('Number', 11);
      $table->decimal('Amount', 20, 2);
      $table->string('ReceiptNumber');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('paymentinfos');
    Schema::dropIfExists('paymenttype_cash');
    Schema::dropIfExists('paymenttype_card');
    Schema::dropIfExists('paymenttype_gcash');
  }
};
