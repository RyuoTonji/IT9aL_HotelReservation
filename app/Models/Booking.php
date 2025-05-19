<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model {
  protected $table = 'BookingDetails';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'UserID',
    'RoomTypeID',
    'CheckInDate',
    'CheckOutDate',
    'NumberOfGuests',
    'RoomSizeID',
    'BookingStatus',
  ];
  public $timestamps = true;
  protected $casts = [
    'CheckInDate' => 'date',
    'CheckOutDate' => 'date',
  ];
  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'UserID', 'ID');
  }

  public function Room(): BelongsTo {
    return $this->belongsTo(Room::class, 'RoomTypeID', 'ID');
  }

  public function RoomSize(): BelongsTo {
    return $this->belongsTo(RoomSizeType::class, 'RoomSizeID', 'ID');
  }

  public function serviceAdded(): HasMany {
    return $this->hasMany(ServiceAdded::class, 'BookingDetailID', 'ID');
  }

  public function Services() {
    return $this->belongsToMany(Service::class, 'ServicesAdded', 'BookingDetailID', 'ServiceID');
  }

  public function paymentInfo(): HasOne {
    return $this->hasOne(PaymentInfo::class, 'BookingDetailID', 'ID');
  }
}
