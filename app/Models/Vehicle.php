<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_number',
        'registration_date',
        'vehicle_type',
        'fuel_type',
        'has_carrier',
        'vehicle_color',
        'seats',
        'accepted_rules',
    ];

    protected $casts = [
        'accepted_rules' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relating to User model
    }
    public function driver()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
