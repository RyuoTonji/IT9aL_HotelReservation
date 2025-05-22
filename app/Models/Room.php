<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
  protected $table = 'Rooms';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'RoomName',
    'RoomTypeID',
    'RoomSizeID',
    'Floor'
  ];

  
  public function roomType() {
    return $this->belongsTo(RoomType::class, 'RoomTypeID', 'ID');
  }

  public function roomSize() {
    return $this->belongsTo(RoomSize::class, 'RoomSizeID', 'ID');
  }

  public function assignedRooms() {
    return $this->hasMany(AssignedRoom::class, 'RoomID', 'ID');
  }
}
