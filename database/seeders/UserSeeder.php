<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('users')->insert(
      [
        [
          'Name' => 'Black Manager',
          'Username' => 'Black Manager',
          'Email' => 'manager@black.com',
          'Password' => bcrypt('password'),
          'Role' => 'Admin',
        ],
        [
          'Name' => 'Default User',
          'Username' => 'defaultuser',
          'Email' => 'defaultuser@com',
          'Password' => bcrypt('password'),
          'Role' => 'Customer',
        ]
      ]
    );
  }
}
