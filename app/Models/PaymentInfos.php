<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentInfos extends Model {
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
    return $this->belongsTo(Booking::class, 'BookingDetailID');
  }

  public function cashPayment() {
    return $this->hasOne(PaymentType_Cash::class, 'PaymentInfoID');
  }

  public function cardPayment() {
    return $this->hasOne(PaymentType_Card::class, 'PaymentInfoID');
  }

  public function ePayment() {
    return $this->hasOne(PaymentType_EPayment::class, 'PaymentInfoID');
  }

  public function paypalPayment() {
    return $this->hasOne(PaymentType_Paypal::class, 'PaymentInfoID');
  }

  public function bankTransferPayment() {
    return $this->hasOne(PaymentType_BankTransfer::class, 'PaymentInfoID');
  }
}
