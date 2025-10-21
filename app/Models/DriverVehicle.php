<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverVehicle extends Model
{
    use SoftDeletes; // Only if using softDeletes in migration

    protected $fillable = [
        'user_id',           // Updated to reflect user_id
        'vehicle_number',
        'registration_date',
        'vehicle_type',
        'fuel_type',
        'vehicle_color',
        'seat_count',
        'has_carrier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relating to User model
    }
}

