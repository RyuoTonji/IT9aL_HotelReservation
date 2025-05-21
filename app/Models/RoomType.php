<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model {
  protected $table = 'RoomTypes';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'RoomTypeName',
    'RoomDescription',
    'RoomPrice',
    'SucceedingNights',
    'ImagePathname',
    'ImageName',
    'MimeType',
  ];

  protected $casts = [
    'RoomPrice' => 'decimal:2',
    'SucceedingNights' => 'decimal:2',
  ];

  public function bookings() {
    return $this->hasMany(Booking::class, 'RoomTypeID', 'ID');
  }

  public function rooms() {
    return $this->hasMany(Room::class, 'RoomTypeID', 'ID');
  }
}
