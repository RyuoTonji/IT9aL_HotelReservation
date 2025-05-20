<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAdded extends Model {
  protected $table = 'ServicesAdded';
  protected $fillable = ['BookingDetailID', 'ServiceID'];

  public function bookingDetail() {
    return $this->belongsTo(Booking::class, 'BookingDetailID');
  }

  public function service() {
    return $this->belongsTo(Service::class, 'ServiceID', 'ID');
  }
}
