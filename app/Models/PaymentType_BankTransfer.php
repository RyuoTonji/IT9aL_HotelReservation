<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_BankTransfer extends Model {
  protected $table = 'PaymentType_BankTransfer';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'PaymentInfoID',
    'AccountName',
    'AccountNumber',
    'RoutingNumber',
  ];

  public function paymentInfo() {
    $this->belongsTo(PaymentInfos::class, 'PaymentInfoID', 'ID');
  }
}
