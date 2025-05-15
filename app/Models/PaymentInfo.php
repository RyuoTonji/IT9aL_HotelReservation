<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentInfo extends Model {
  protected $table = 'PaymentInfos';

  protected $primaryKey = 'PaymentID';

  protected $fillable = [
    'BookingDetailID',
    'TotalAmount',
    'PaymentStatus',
    'PaymentMethod',
  ];

  protected $casts = [
    'TotalAmount' => 'decimal:2',
    'PaymentStatus' => 'string', // Enum: Pending, Completed, Failed
  ];

  public function bookingDetail(): BelongsTo {
    return $this->belongsTo(BookingDetail::class, 'BookingDetailID', 'BookingDetailID');
  }
}
