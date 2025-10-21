<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideBooking extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_type',
        'boarding_point',
        'destination_point',
        'carrier_required',
        'alternate_contact',
        'ac_required',
        'booking_amount',
        'commission',
        'total_driver_payment',
        'driver_id',
        'ride_status',
        'distance',
        'pickup_date',
        'pickup_time',
        'payment_method',
        
    ];
    public function drivers()
{
    return $this->belongsToMany(User::class, 'ride_driver', 'ride_id', 'driver_id')->withTimestamps();
}

}

