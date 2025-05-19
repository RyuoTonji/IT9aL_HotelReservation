<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashbackThreshold extends Model {
  protected $table = 'CashbackThresholds';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'ThresholdName',
    'ThresholdDescription',
    'MinPaidAmount',
    'CashbackPercentile',
  ];

  protected $casts = [
    'MinPaidAmount' => 'decimal:2',
    'CashbackPercentile' => 'decimal:2'
  ];
}
