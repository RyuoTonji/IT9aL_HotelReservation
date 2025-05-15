<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   */
  public function run(): void {
    // User::factory(10)->create();

    // User::factory()->create([
    //   'name' => 'Test User',
    //   'email' => 'test@example.com',
    // ]);
    DB::table('users')->insert(
      [
        [
          'name' => 'Black Manager',
          'username' => 'Black Manager',
          'email' => 'manager@black.com',
          'password' => bcrypt('password'), // password
          'role' => 'Admin',
        ],
        [
          'name' => 'Default User',
          'username' => 'defaultuser',
          'email' => 'defaultuser@com',
          'password' => bcrypt('defaultuser'), // password
          'role' => 'Customer',
        ]
      ]
    );

    DB::table('Rooms')->insert([
      [
        'RoomName' => 'Standard Room',
        'RoomDescription' => 'A cozy room with basic amenities.',
        'RoomType' => 'Standard',
        'RoomPrice' => 50000.00,
        'RoomCapacity' => 1,
        'ImagePathname' => 'img/rooms/RoomStandard.png',
        'ImageName' => 'RoomStandard.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'RoomName' => 'Superior Room',
        'RoomDescription' => 'A superior room with premium amenities.',
        'RoomType' => 'Executive',
        'RoomPrice' => 100000.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomSuperior.jpg',
        'ImageName' => 'RoomSuperior.jpg',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'RoomName' => 'Deluxe Room',
        'RoomDescription' => 'A luxurious room with top-notch facilities.',
        'RoomType' => 'Deluxe',
        'RoomPrice' => 999999.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomDeluxe.png',
        'ImageName' => 'RoomDeluxe.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);

    DB::table('Services')->insert([
      [
        'ServiceName' => 'Food and Beverage Service',
        'ServiceDescription' => 'Food and beverage service available 24/7.',
        'ServicePrice' => 500000.00,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/food.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'ServiceName' => 'Pool Service',
        'ServiceDescription' => 'Pool service available from 8 AM to 10 PM.',
        'ServicePrice' => 399999.99,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/pool2.jpg',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'ServiceName' => 'Gym Service',
        'ServiceDescription' => 'Gym service available from 6 AM to 10 PM.',
        'ServicePrice' => 999999.99,
        'ServiceStatus' => 'Available',
        'ImagePathname' => 'img/services/gym.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]
    ]);
  }
}
