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

    $this->call([
      UserSeeder::class,
      RoomSizeSeeder::class,
      RoomTypeSeeder::class,
      RoomSeeder::class,
      ServiceSeeder::class,
      CashbackThresholdSeeder::class,
      LoyaltyTierSeeder::class,
    ]);
  }
}
