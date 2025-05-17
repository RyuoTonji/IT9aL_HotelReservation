<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicesAddedOnBooking extends Model {
  protected $table = 'ServicesAddedOnBookings';

  protected $primaryKey = 'ID';

  protected $fillable = [
    'BookingDetailID',
    'ServiceID',
  ];

  public function bookingDetail(): BelongsTo {
    return $this->belongsTo(BookingDetail::class, 'BookingDetailID', 'ID');
  }

  public function service(): BelongsTo {
    return $this->belongsTo(Service::class, 'ServiceID', 'ID');
  }
}
