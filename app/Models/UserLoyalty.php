<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoyalty extends Model {
  protected $table = 'UserLoyalty';
  protected $primaryKey = 'ID';
  protected $fillable = ['UserID', 'LoyaltyPoints', 'LoyaltyTierID'];

  protected $casts = [
    'LoyaltyPoints' => 'decimal:2',
  ];

  public function user() {
    return $this->belongsTo(User::class, 'UserID', 'ID');
  }

  public function loyaltyTier() {
    return $this->belongsTo(LoyaltyTier::class, 'LoyaltyTierID', 'ID');
  }
}
