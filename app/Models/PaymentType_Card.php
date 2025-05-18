<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType_Card extends Model {
  protected $table = 'PaymentType_Card';
  protected $fillable = ['PaymentInfoID', 'Name', 'CardNumber', 'Expiry', 'CVC'];

  protected $casts = [
    'CardNumber' => 'encrypted',
    'CVC' => 'encrypted',
  ];

  public function paymentInfo() {
    return $this->belongsTo(PaymentInfo::class, 'PaymentInfoID', 'ID');
  }
}
