<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_EPayment extends Model {
  protected $table = 'PaymentType_EPayment';
  protected $fillable = ['PaymentInfoID', 'Name', 'Number', 'Amount', 'ReferenceNum'];

  protected $casts = [
    'Amount' => 'decimal:2',
  ];

  public function paymentInfo() {
    return $this->belongsTo(PaymentInfos::class, 'PaymentInfoID', 'ID');
  }
}
