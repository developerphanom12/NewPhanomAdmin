<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSOS extends Model
{
    use HasFactory;

    protected $table = 'user_s_o_s';

    protected $fillable = [
        'user_id',
        'ride_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ride()
    {
        return $this->belongsTo(RideBooking::class, 'ride_id');
    }
}
