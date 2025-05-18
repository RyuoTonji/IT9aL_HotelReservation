<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSizeTypeSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('RoomSizeTypes')->insert([
      [
        'RoomSizeName' => 'Single',
        'RoomSizeDescription' => 'Small room size.',
        'RoomCapacity' => 1,
        'PricePerPerson' => 0,
        'RoomSizePrice' => 50000.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomSizeName' => 'Double',
        'RoomSizeDescription' => 'Good for 2 people.',
        'RoomCapacity' => 2,
        'PricePerPerson' => 200.00,
        'RoomSizePrice' => 100000.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'RoomSizeName' => 'Family',
        'RoomSizeDescription' => 'Family room size.',
        'RoomCapacity' => 10,
        'PricePerPerson' => 500.00,
        'RoomSizePrice' => 999999.00,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
