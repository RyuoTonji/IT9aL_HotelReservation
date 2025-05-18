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
    'RoomID',
    'CheckInDate',
    'CheckOutDate',
    'NumberOfGuests',
    'RoomSize',
    'BookingStatus',
  ];
  public $timestamps = true;
  public function user(): BelongsTo {
    return $this->belongsTo(User::class, 'UserID', 'ID');
  }

  public function room(): BelongsTo {
    return $this->belongsTo(Room::class, 'RoomID', 'ID');
  }

  public function servicesAdded(): HasMany {
    return $this->hasMany(ServiceAdded::class, 'ID', 'ID');
  }

  public function paymentInfo(): HasOne {
    return $this->hasOne(PaymentInfo::class, 'ID', 'ID');
  }
}
