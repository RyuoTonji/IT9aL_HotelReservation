<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::table('users', function (Blueprint $table) {
      $table->string('username')->unique()->after('name');
      $table->enum('Role', ['Admin', 'Cashier', 'Customer'])->default('User')->after('Password');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('username');
      $table->dropColumn('Role');
    });
  }
};
