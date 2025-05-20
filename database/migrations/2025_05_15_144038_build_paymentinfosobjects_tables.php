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
      $table->enum('PaymentStatus', ['Pending', 'Submitted', 'Verified', 'Failed'])->default('Pending');
      $table->enum('PaymentMethod', ['Cash', 'Card', 'EPayment', 'Paypal', 'BankTransfer'])->default('Cash');
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
      $table->string('CardHolderName')->nullable();
      $table->string('CardNumber');
      $table->string('ExpiryDate', 5);
      $table->string('CVC', 4)->nullable();
      $table->timestamps();
    });

    Schema::create('paymenttype_epayment', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->string('Name')->nullable();
      $table->string('Provider')->nullable();
      $table->string('Number', 11)->nullable();
      $table->decimal('Amount', 20, 2)->nullable();
      $table->string('ReferenceNum')->nullable();
      $table->timestamps();
    });

    Schema::create('paymenttype_paypal', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->string('Name')->nullable();
      $table->string('Amount')->nullable();
      $table->string('ReferenceNum')->nullable();
      $table->timestamps();
    });

    Schema::create('paymenttype_banktransfer', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('PaymentInfoID')->constrained('PaymentInfos', 'ID')->onDelete('cascade');
      $table->string('AccountName')->nullable();
      $table->string('AccountNumber')->nullable();
      $table->string('RoutingNumber')->nullable();
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
    Schema::dropIfExists('paymenttype_epayment');
    Schema::dropIfExists('paymenttype_paypal');
    Schema::dropIfExists('paymenttype_banktransfer');
  }
};
