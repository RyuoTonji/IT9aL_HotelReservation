<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPointTransaction extends Model {
  protected $table = 'LoyaltyPointTransactions';
  protected $primaryKey = 'ID';
  protected $fillable = ['UserID', 'Points', 'TransactionType', 'PaymentInfoID', 'Description'];

  protected $casts = [
    'Points' => 'decimal:2',
    'TransactionType' => 'string',
  ];

  public function user() {
    return $this->belongsTo(User::class, 'UserID', 'ID');
  }

  public function paymentInfo() {
    return $this->belongsTo(PaymentInfos::class, 'PaymentInfoID', 'ID');
  }
}
