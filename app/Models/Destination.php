<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'boarding_point',
        'destination_point',
        'distance',
        'destination_range',
        'commission_alto',
        'commission_sedan',
        'commission_ertiga',
        'total_fare_alto',
        'total_fare_sedan',
        'total_fare_ertiga',
        'driver_fare_alto',
        'driver_fare_sedan',
        'driver_fare_ertiga',
        'min_booking_alto',
        'min_booking_sedan',
        'min_booking_ertiga',
        'is_enabled'
    ];

    protected $casts = [
        'distance' => 'float',
        'commission_alto' => 'float',
        'commission_sedan' => 'float',
        'commission_ertiga' => 'float',
        'total_fare_alto' => 'float',
        'total_fare_sedan' => 'float',
        'total_fare_ertiga' => 'float',
        'driver_fare_alto' => 'float',
        'driver_fare_sedan' => 'float',
        'driver_fare_ertiga' => 'float',
        'min_booking_alto' => 'float',
        'min_booking_sedan' => 'float',
        'min_booking_ertiga' => 'float',
        'is_enabled' => 'boolean',
    ];
} 