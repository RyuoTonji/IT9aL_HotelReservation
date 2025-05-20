<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingCostDetail extends Model {
  protected $table = 'BookingCostDetails';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'BookingDetailID',
    'RoomBasePrice',
    'RoomSucceedingNightsPrice',
    'Nights',
    'GuestFee',
    'ServiceBasePrice',
    'ServiceSucceedingNightsPrice',
    'Subtotal',
    'Discount',
    'TotalAmount'
  ];

  protected $casts = [
    'RoomBasePrice' => 'decimal:2',
    'RoomSucceedingNightsPrice' => 'decimal:2',
    'GuestFee' => 'decimal:2',
    'ServiceBasePrice' => 'decimal:2',
    'ServiceSucceedingNightsPrice' => 'decimal:2',
    'Subtotal' => 'decimal:2',
    'Discount' => 'decimal:2',
    'TotalAmount' => 'decimal:2',
  ];

  public function booking() {
    return $this->belongsTo(Booking::class, 'BookingDetailID', 'ID');
  }
}
