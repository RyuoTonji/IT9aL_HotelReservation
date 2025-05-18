<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('Services')->insert([
      [
        'ServiceName' => 'Food and Beverage Service',
        'ServiceDescription' => 'Food and beverage service available 24/7.',
        'ServicePrice' => 500000.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/food.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ServiceName' => 'Pool Service',
        'ServiceDescription' => 'Pool service available from 8 AM to 10 PM.',
        'ServicePrice' => 399999.99,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/pool2.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ServiceName' => 'Gym Service',
        'ServiceDescription' => 'Gym service available from 6 AM to 10 PM.',
        'ServicePrice' => 999999.99,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/gym.png',
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }
}
