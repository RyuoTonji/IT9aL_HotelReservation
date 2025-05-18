<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomSizeType extends Model {
  protected $table = 'RoomSizeTypes';
  protected $primaryKey = 'ID';
  protected $fillable = ['RoomSizeName', 'RoomSizeDescription', 'RoomCapacity', 'PricePerPerson', 'RoomSizePrice'];

  protected $casts = [
    'RoomCapacity' => 'integer',
    'PricePerPerson' => 'decimal:2',
    'RoomSizePrice' => 'decimal:2',
  ];
}
