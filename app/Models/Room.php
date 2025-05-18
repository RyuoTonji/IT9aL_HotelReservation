<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model {
  protected $table = 'RoomTypes';

  protected $primaryKey = 'ID';

  protected $fillable = [
    'RoomTypeName',
    'RoomDescription',
    'RoomPrice',
    'RoomCapacity',
    'ImagePathname',
    'ImageName',
    'MimeType',
  ];

  protected $casts = [
    'RoomPrice' => 'decimal:2',
  ];

  public function bookingDetails(): HasMany {
    return $this->hasMany(BookingDetail::class, 'ID', 'ID');
  }
}
