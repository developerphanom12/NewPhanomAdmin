<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraCityCosting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Moto (Bike)
        'basic_amount_moto',
        'per_km_price_moto',
        'kabby_shares_moto',
        'kabby_amount_moto',
        
        // Mini (Alto/Wagon R)
        'basic_amount_mini',
        'per_km_price_mini',
        'kabby_shares_mini',
        'kabby_amount_mini',
        
        // Sedan
        'basic_amount_sedan',
        'per_km_price_sedan',
        'kabby_shares_sedan',
        'kabby_amount_sedan',
        
        // Ertiga
        'basic_amount_ertiga',
        'per_km_price_ertiga',
        'kabby_shares_ertiga',
        'kabby_amount_ertiga',
        
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'basic_amount_moto' => 'decimal:2',
        'per_km_price_moto' => 'decimal:2',
        'kabby_amount_moto' => 'decimal:2',
        'basic_amount_mini' => 'decimal:2',
        'per_km_price_mini' => 'decimal:2',
        'kabby_amount_mini' => 'decimal:2',
        'basic_amount_sedan' => 'decimal:2',
        'per_km_price_sedan' => 'decimal:2',
        'kabby_amount_sedan' => 'decimal:2',
        'basic_amount_ertiga' => 'decimal:2',
        'per_km_price_ertiga' => 'decimal:2',
        'kabby_amount_ertiga' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
