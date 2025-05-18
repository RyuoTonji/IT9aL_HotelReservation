<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashbackThresholdSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('CashbackThresholds')->insert([
      [
        'ThresholdName' => '1%',
        'ThresholdDescription' => '1% Cashback through Loyalty Points',
        'MinPaidAmount' => 5000,
        'CashbackPercentile' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '2%',
        'ThresholdDescription' => '2% Cashback through Loyalty Points',
        'MinPaidAmount' => 10000,
        'CashbackPercentile' => 2,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '5%',
        'ThresholdDescription' => '5% Cashback through Loyalty Points',
        'MinPaidAmount' => 20000,
        'CashbackPercentile' => 5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '7.5%',
        'ThresholdDescription' => '7.5% Cashback through Loyalty Points',
        'MinPaidAmount' => 50000,
        'CashbackPercentile' => 7.5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '10%',
        'ThresholdDescription' => '10% Cashback through Loyalty Points',
        'MinPaidAmount' => 100000,
        'CashbackPercentile' => 10,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '15%',
        'ThresholdDescription' => '15% Cashback through Loyalty Points',
        'MinPaidAmount' => 200000,
        'CashbackPercentile' => 15,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
