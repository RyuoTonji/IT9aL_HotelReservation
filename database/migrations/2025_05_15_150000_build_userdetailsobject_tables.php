<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('UserLoyalty', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('UserID')->constrained('users', 'ID')->onDelete('cascade');
      $table->decimal('LoyaltyPoints', 20, 2)->default(0);
      $table->foreignId('LoyaltyTierID')->nullable()->constrained('LoyaltyTiers', 'ID')->onDelete('set null');
      $table->timestamps();
    });

    Schema::create('LoyaltyPointTransactions', function (Blueprint $table) {
      $table->id('ID');
      $table->foreignId('UserID')->constrained('users', 'ID')->onDelete('cascade');
      $table->decimal('Points', 20, 2);
      $table->enum('TransactionType', ['Earned', 'Spent'])->default('Earned');
      $table->foreignId('PaymentInfoID')->nullable()->constrained('PaymentInfos', 'ID')->onDelete('set null');
      $table->string('Description')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('LoyaltyPointTransactions');
    Schema::dropIfExists('UserLoyalty');
  }
};
