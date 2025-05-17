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
          'Name' => 'Black Manager',
          'Username' => 'Black Manager',
          'Email' => 'manager@black.com',
          'Password' => bcrypt('password'), // password
          'Role' => 'Admin',
        ],
        [
          'Name' => 'Default User',
          'Username' => 'defaultuser',
          'Email' => 'defaultuser@com',
          'Password' => bcrypt('defaultuser'), // password
          'Role' => 'Customer',
        ]
      ]
    );

    // DB::table('RoomTypes')->insert([
    //   [
    //     'RoomTypeName' => 'Standard',
    //     'RoomTypeDescription' => 'Standard room with basic amenities.',
    //     'RoomTypePrice' => 50000.00,
    //     'created_at' => Carbon::now(),
    //     'updated_at' => Carbon::now(),
    //   ],
    //   [
    //     'RoomTypeName' => 'Executive',
    //     'RoomTypeDescription' => 'Executive room with premium amenities.',
    //     'RoomTypePrice' => 100000.00,
    //     'created_at' => Carbon::now(),
    //     'updated_at' => Carbon::now(),
    //   ],
    //   [
    //     'RoomTypeName' => 'Deluxe',
    //     'RoomTypeDescription' => 'Deluxe room with luxurious amenities.',
    //     'RoomTypePrice' => 999999.00,
    //     'created_at' => Carbon::now(),
    //     'updated_at' => Carbon::now(),
    //   ],
    // ]);

    DB::table('RoomSizes')->insert([
      [
        'RoomSizeName' => 'Single',
        'RoomSizeDescription' => 'Small room size.',
        'RoomCapacity' => 1,
        'PricePerPerson' => 0,
        'RoomSizePrice' => 50000.00,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'RoomSizeName' => 'Double',
        'RoomSizeDescription' => 'Medium room size.',
        'RoomCapacity' => 2,
        'PricePerPerson' => 200.00,
        'RoomSizePrice' => 100000.00,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'RoomSizeName' => 'Family',
        'RoomSizeDescription' => 'Large room size.',
        'RoomCapacity' => 10,
        'PricePerPerson' => 500.00,
        'RoomSizePrice' => 999999.00,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);

    DB::table('Rooms')->insert([
      [
        'RoomName' => 'Standard Room',
        'RoomDescription' => 'A cozy room with basic amenities.',
        // 'RoomType' => 1,
        'RoomPrice' => 50000.00,
        'RoomCapacity' => 1,
        'ImagePathname' => 'img/rooms/RoomStandard.png',
        'ImageName' => 'RoomStandard.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'RoomName' => 'Executive Room',
        'RoomDescription' => 'A superior room with premium amenities.',
        // 'RoomTypeID' => 2,
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
        // 'RoomTypeID' => 3,
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

    DB::table('LoyaltyPointsThresholds')->insert([
      [
        'ThresholdName' => 'Bronze',
        'MinAmount' => 0,
        'MaxAmount' => 500,
        'LoyaltyPointsPercentile' => 2,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => 'Silver',
        'MinAmount' => 501,
        'MaxAmount' => 2000,
        'LoyaltyPointsPercentile' => 5,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'ThresholdName' => 'Gold',
        'MinAmount' => 2001,
        'MaxAmount' => 0, // 0 means no upper limit
        'LoyaltyPointsPercentile' => 10,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
