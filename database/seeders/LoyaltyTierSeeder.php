<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoyaltyTierSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    DB::table('LoyaltyTiers')->insert([
      [
        'TierName' => 'Bronze',
        'TierDescription' => '1% Discount. Atleast 1000 Loyalty Pts to attain.',
        'MinPoints' => 1000,
        'Discount' => 1,
      ],
      [
        'TierName' => 'Silver',
        'TierDescription' => '2% Discount. Atleast 2000 Loyalty Pts to attain.',
        'MinPoints' => 2000,
        'Discount' => 2,
      ],
      [
        'TierName' => 'Gold',
        'TierDescription' => '4% Discount. Atleast 3000 Loyalty Pts to attain.',
        'MinPoints' => 3000,
        'Discount' => 4,
      ],
      [
        'TierName' => 'Platinum',
        'TierDescription' => '7% Discount. Atleast 6000 Loyalty Pts to attain.',
        'MinPoints' => 6000,
        'Discount' => 7,
      ],
      [
        'TierName' => 'Diamond',
        'TierDescription' => '10% Discount. Atleast 10000 Loyalty Pts to attain.',
        'MinPoints' => 10000,
        'Discount' => 10,
      ],
      [
        'TierName' => 'Master',
        'TierDescription' => '15% Discount. Atleast 15000 Loyalty Pts to attain.',
        'MinPoints' => 15000,
        'Discount' => 15,
      ],
      [
        'TierName' => 'Elite',
        'TierDescription' => '20% Discount. Atleast 20000 Loyalty Pts to attain.',
        'MinPoints' => 20000,
        'Discount' => 20,
      ],
      [
        'TierName' => 'Grandmaster',
        'TierDescription' => '30% Discount. Atleast 50000 Loyalty Pts to attain.',
        'MinPoints' => 50000,
        'Discount' => 30,
      ],
      [
        'TierName' => 'Legendary',
        'TierDescription' => '40% Discount. Atleast 100000 Loyalty Pts to attain.',
        'MinPoints' => 100000,
        'Discount' => 40,
      ],
      [
        'TierName' => 'Universal',
        'TierDescription' => '50% Discount. Atleast 250000 Loyalty Pts to attain.',
        'MinPoints' => 250000,
        'Discount' => 50,
      ],
      [
        'TierName' => 'Upheaval',
        'TierDescription' => '75% Discount. Atleast 500000 Loyalty Pts to attain.',
        'MinPoints' => 500000,
        'Discount' => 75,
      ],
      [
        'TierName' => 'Celestial Embodiment',
        'TierDescription' => '100% Discount. Atleast 1000000 Loyalty Pts to attain. How the fuck are you able to reach this tier?',
        'MinPoints' => 1000000,
        'Discount' => 100,
      ],
    ]);
  }
}
