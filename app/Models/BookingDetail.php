<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingDetail extends Model {
  protected $table = 'bookingdetails';

  protected $primaryKey = 'BookingDetailID';

  protected $fillable = [
    'UserID',
    'RoomID',
    'CheckInDate',
    'CheckOutDate',
    'NumberOfGuests',
    'BookingStatus',
  ];

  protected $casts = [
    'CheckInDate' => 'datetime',
    'CheckOutDate' => 'datetime',
    'BookingStatus' => 'string', // Enum: Pending, Confirmed, Cancelled
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'UserID', 'id');
  }

  public function room(): BelongsTo {
    return $this->belongsTo(Room::class, 'RoomID', 'RoomID');
  }

  public function servicesAdded(): HasMany {
    return $this->hasMany(ServicesAddedOnBooking::class, 'BookingDetailID', 'BookingDetailID');
  }

  public function paymentInfo(): HasOne {
    return $this->hasOne(PaymentInfo::class, 'BookingDetailID', 'BookingDetailID');
  }
}
