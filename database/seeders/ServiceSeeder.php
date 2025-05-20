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
    DB::table('Services')->insertOrIgnore([
      [
        'ServiceName' => 'Food and Beverage Service',
        'ServiceDescription' => 'Food and beverage service available 24/7.',
        'ServicePrice' => 1500.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/food.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ServiceName' => 'Rooftop Infinity Pool',
        'ServiceDescription' => 'Pool service available from 8 AM to 10 PM. \n Enjoy breathtaking views of Davao City from our rooftop infinity pool, complete with poolside service and comfortable lounge areas.',
        'ServicePrice' => 2000.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/pool2.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ServiceName' => 'Fitness Center',
        'ServiceDescription' => 'Gym service available from 6 AM to 10 PM. \n Stay active in our state-of-the-art fitness center, equipped with modern cardio machines, free weights, and personal training sessions available upon request.',
        'ServicePrice' => 1000.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/gym.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ServiceName' => 'Spa & Wellness',
        'ServiceDescription' => 'Gym service available from 6 AM to 10 PM. \n Indulge in relaxation with our luxurious spa, offering a range of treatments including massages, facials, and holistic therapies for ultimate rejuvenation.',
        'ServicePrice' => 750.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/spa.png',
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }
}
