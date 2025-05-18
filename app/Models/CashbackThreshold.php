<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashbackThreshold extends Model {
  protected $table = 'CashbackThreshold';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'ThresholdName',
    'ThresholdDescription',
    'MinPaidAmount',
    'CashbackPercentile',
  ];

  protected $casts = [
    'MinPaidAmount' => 'integer',
    'CashbackPercentile' => 'decimal'
  ];
}
