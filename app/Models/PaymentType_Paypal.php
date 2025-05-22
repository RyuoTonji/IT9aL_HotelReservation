<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_Paypal extends Model {
  protected $table = 'PaymentType_Paypal';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'PaymentInfoID',
    'Name',
    'Amount',
    'ReferenceNumber',
  ];

  protected $casts = [
    'Amount' => 'decimal:2'
  ];

  public function paymentInfo() {
    $this->belongsTo(PaymentInfos::class, 'PaymentInfoID', 'ID');
  }
}
