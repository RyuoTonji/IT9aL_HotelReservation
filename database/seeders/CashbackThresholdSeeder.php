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
        'ThresholdName' => '0.25%',
        'ThresholdDescription' => '0.25% Cashback through Loyalty Points',
        'MinPaidAmount' => 10000,
        'CashbackPercentile' => .25,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '0.5%',
        'ThresholdDescription' => '0.5% Cashback through Loyalty Points',
        'MinPaidAmount' => 30000,
        'CashbackPercentile' => .5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '0.75%',
        'ThresholdDescription' => '0.75% Cashback through Loyalty Points',
        'MinPaidAmount' => 50000,
        'CashbackPercentile' => .75,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '1%',
        'ThresholdDescription' => '1% Cashback through Loyalty Points',
        'MinPaidAmount' => 75000,
        'CashbackPercentile' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '2%',
        'ThresholdDescription' => '2% Cashback through Loyalty Points',
        'MinPaidAmount' => 100000,
        'CashbackPercentile' => 2,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '3%',
        'ThresholdDescription' => '3% Cashback through Loyalty Points',
        'MinPaidAmount' => 200000,
        'CashbackPercentile' => 3,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '4%',
        'ThresholdDescription' => '4% Cashback through Loyalty Points',
        'MinPaidAmount' => 500000,
        'CashbackPercentile' => 4,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '5%',
        'ThresholdDescription' => '5% Cashback through Loyalty Points',
        'MinPaidAmount' => 750000,
        'CashbackPercentile' => 5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '7.5%',
        'ThresholdDescription' => '7.5% Cashback through Loyalty Points',
        'MinPaidAmount' => 1000000,
        'CashbackPercentile' => 7.5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => '10%',
        'ThresholdDescription' => '10% Cashback through Loyalty Points',
        'MinPaidAmount' => 2500000,
        'CashbackPercentile' => 10,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
