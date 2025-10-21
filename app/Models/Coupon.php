<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'amount',
        'coupon_code',
        'validity',
        'is_enabled',
        'is_public',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_public' => 'boolean',
        'validity' => 'date',
        'amount' => 'float',
    ];
} 