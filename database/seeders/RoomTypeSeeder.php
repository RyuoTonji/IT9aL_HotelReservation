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
        'RoomDescription'
        => 'Ideal for families, Couple, and many more our Standard Suite includes multiple bedrooms, a cozy living area, and child-friendly amenities for a comfortable stay.',
        'RoomPrice' => 10000.00,
        'SucceedingNights' => 2000.00,
        'RoomCapacity' => 1,
        'ImagePathname' => 'img/rooms/RoomStandard.png',
        'ImageName' => 'RoomStandard.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomTypeName' => 'Executive',
        'RoomDescription' => 'Perfect for business travelers, our Executive Suite offers a spacious living area, high-speed Wi-Fi, and a dedicated workspace for productivity.',
        'RoomPrice' => 15000.00,
        'SucceedingNights' => 5000.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomSuperior.jpg',
        'ImageName' => 'RoomSuperior.jpg',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomTypeName' => 'Deluxe',
        'RoomDescription' => 'Experience elegance in our Deluxe King Room, featuring a plush king-sized bed, modern amenities, and a private balcony with city views.',
        'RoomPrice' => 20000.00,
        'SucceedingNights' => 7000.00,
        'RoomCapacity' => 2,
        'ImagePathname' => 'img/rooms/RoomDeluxe.png',
        'ImageName' => 'RoomDeluxe.png',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
