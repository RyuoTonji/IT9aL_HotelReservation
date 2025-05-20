<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSizeSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('RoomSizes')->insert([
      [
        'RoomSizeName' => 'Single',
        'RoomSizeDescription' => 'Small room size.',
        'RoomCapacity' => 1,
        'PricePerPerson' => 0,
        'RoomSizePrice' => 1000.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomSizeName' => 'Double',
        'RoomSizeDescription' => 'Good for 2 people.',
        'RoomCapacity' => 2,
        'PricePerPerson' => 0,
        'RoomSizePrice' => 2500.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomSizeName' => 'Family',
        'RoomSizeDescription' => 'Family room size.',
        'RoomCapacity' => 10,
        'PricePerPerson' => 250.00,
        'RoomSizePrice' => 10000.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
