<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultManagerAccountSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    User::factory()->create([
      'name' => 'Nigger Manager',
      'username' => 'Gigganigga Manager',
      'email' => 'manager.example.com',
      'password' => bcrypt('password'), // password
      'role' => 'manager',
    ]);
  }
}
