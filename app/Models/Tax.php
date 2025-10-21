<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_title',
        'country',
        'tax_type',
        'tax_amount',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tax_amount' => 'float'
    ];
} 