<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_Cash extends Model {
  protected $table = 'PaymentType_Cash';

  protected $primaryKey = 'ID';
  protected $fillable = ['PaymentInfoID', 'CashAmount'];

  protected $casts = [
    'Amount' => 'decimal:2',
  ];

  public function paymentInfo() {
    return $this->belongsTo(PaymentInfo::class, 'PaymentInfoID', 'ID');
  }
}
