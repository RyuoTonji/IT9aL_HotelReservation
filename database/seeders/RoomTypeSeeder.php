<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('RoomTypes')->insert([
      [
        'RoomTypeName' => 'Standard',
        'RoomDescription' => 'A cozy room with basic amenities.',
        // 'RoomType' => 1,
        'RoomPrice' => 50000.00,
        'RoomCapacity' => 1,
        'ImagePathname' => 'img/rooms/RoomStandard.png',
        'ImageName' => 'RoomStandard.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomTypeName' => 'Executive',
        'RoomDescription' => 'A superior room with premium amenities.',
        // 'RoomTypeID' => 2,
        'RoomPrice' => 100000.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomSuperior.jpg',
        'ImageName' => 'RoomSuperior.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomTypeName' => 'Deluxe',
        'RoomDescription' => 'A luxurious room with top-notch facilities.',
        // 'RoomTypeID' => 3,
        'RoomPrice' => 999999.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomDeluxe.png',
        'ImageName' => 'RoomDeluxe.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
