<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentInfo extends Model {
  protected $table = 'PaymentInfos';

  protected $primaryKey = 'ID';

  protected $fillable = [
    'BookingDetailID',
    'TotalAmount',
    'PaymentStatus',
    'PaymentMethod',
  ];

  protected $casts = [
    'TotalAmount' => 'decimal:2',
    'PaymentStatus' => 'string', // Enum: Pending, Completed, Failed
    'PaymentMethod' => 'string', // Enum: CreditCard, PayPal, BankTransfer
  ];

  public function bookingDetail() {
    return $this->belongsTo(BookingDetail::class, 'BookingDetailID');
  }

  public function cashPayment() {
    return $this->hasOne(PaymentType_Cash::class, 'PaymentInfoID');
  }

  public function cardPayment() {
    return $this->hasOne(PaymentType_Card::class, 'PaymentInfoID');
  }

  public function gcashPayment() {
    return $this->hasOne(PaymentType_GCash::class, 'PaymentInfoID');
  }
}
