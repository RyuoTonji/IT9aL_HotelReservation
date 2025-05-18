<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_GCash extends Model {
  protected $table = 'PaymentType_GCash';
  protected $fillable = ['PaymentInfoID', 'Name', 'Number', 'Amount', 'Receipt'];

  protected $casts = [
    'Amount' => 'decimal:2',
  ];

  public function paymentInfo() {
    return $this->belongsTo(PaymentInfo::class, 'PaymentInfoID', 'ID');
  }
}
