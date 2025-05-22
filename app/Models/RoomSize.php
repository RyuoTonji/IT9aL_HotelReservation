<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomSize extends Model {
  protected $table = 'RoomSizes';
  protected $primaryKey = 'ID';
  protected $fillable = ['RoomSizeName', 'RoomSizeDescription', 'RoomCapacity', 'PricePerPerson', 'RoomSizePrice'];

  protected $casts = [
    'RoomCapacity' => 'integer',
    'PricePerPerson' => 'decimal:2',
    'RoomSizePrice' => 'decimal:2',
  ];

  public function rooms() {
    return $this->hasMany(Room::class, 'RoomSizeID', 'ID');
  }

  public function bookings() {
    return $this->hasMany(Booking::class, 'RoomSizeID', 'ID');
  }
}
