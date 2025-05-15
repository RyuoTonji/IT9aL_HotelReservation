<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model {
  protected $table = 'Services';

  protected $primaryKey = 'ServiceID';

  protected $fillable = [
    'ServiceName',
    'ServiceDescription',
    'ServicePrice',
    'ServiceStatus',
    'ImagePathname',
    'ImageName',
    'MimeType',
  ];

  protected $casts = [
    'ServicePrice' => 'decimal:2',
    'ServiceStatus' => 'string', // Enum: Available, Unavailable
  ];

  public function servicesAdded(): HasMany {
    return $this->hasMany(ServicesAddedOnBooking::class, 'ServiceID', 'ServiceID');
  }
}
