<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomType extends Model {
  protected $table = 'RoomTypes';

  protected $primaryKey = 'ID';

  protected $fillable = [
    'RoomTypeName',
    'RoomDescription',
    'RoomPrice',
    'SucceedingNights',
    'RoomCapacity',
    'ImagePathname',
    'ImageName',
    'MimeType',
  ];

  protected $casts = [
    'RoomPrice' => 'decimal:2',
    'SucceedingNights' => 'decimal:2',
  ];

  public function bookingDetails(): HasMany {
    return $this->hasMany(Booking::class, 'ID', 'ID');
  }
}
