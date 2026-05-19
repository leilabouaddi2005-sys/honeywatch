<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeolocationCache extends Model
{
    public $timestamps = false;

    protected $table = 'geolocation_cache';

    protected $fillable = [
        'ip_address',
        'country',
        'city',
        'isp',
        'lat',
        'lng',
        'cached_at',
    ];

    protected $casts = [
        'cached_at' => 'datetime',
    ];
}