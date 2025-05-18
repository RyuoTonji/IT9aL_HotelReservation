<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTier extends Model {
  protected $table = 'LoyaltyTiers';
  protected $primaryKey = 'ID';
  protected $fillable = ['TierName', 'TierDescription', 'MinPoints', 'Discount'];

  protected $casts = [
    'MinPoints' => 'integer',
    'Discount' => 'decimal',
  ];
}
