<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedRoom extends Model {
  protected $table = 'AssignedRooms';
  protected $primaryKey = 'ID';
  protected $fillable = [
    'BookingDetailID',
    'RoomID',
    'Status',
  ];

  public function booking() {
    return $this->belongsTo(Booking::class, 'BookingDetailID', 'ID');
  }

  public function room() {
    return $this->belongsTo(Room::class, 'RoomID', 'ID');
  }
}
