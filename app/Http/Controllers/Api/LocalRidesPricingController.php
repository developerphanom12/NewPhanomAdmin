<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IntraCityCosting;
use Illuminate\Http\Request;

class LocalRidesPricingController extends Controller
{
    /**
     * Get the current active local rides pricing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPricing()
    {
        $pricing = IntraCityCosting::where('is_active', true)->first();
        
        if (!$pricing) {
            return response()->json([
                'status' => false,
                'message' => 'No active pricing found',
                'data' => null
            ], 404);
        }
        
        // Group pricing data by vehicle type
        $formattedPricing = [
            'moto' => [
                'basic_amount' => $pricing->basic_amount_moto,
                'per_km_price' => $pricing->per_km_price_moto,
                'kabby_shares_type' => $pricing->kabby_shares_moto,
                'kabby_amount' => $pricing->kabby_amount_moto,
            ],
            'mini' => [
                'basic_amount' => $pricing->basic_amount_mini,
                'per_km_price' => $pricing->per_km_price_mini,
                'kabby_shares_type' => $pricing->kabby_shares_mini,
                'kabby_amount' => $pricing->kabby_amount_mini,
            ],
            'sedan' => [
                'basic_amount' => $pricing->basic_amount_sedan,
                'per_km_price' => $pricing->per_km_price_sedan,
                'kabby_shares_type' => $pricing->kabby_shares_sedan,
                'kabby_amount' => $pricing->kabby_amount_sedan,
            ],
            'ertiga' => [
                'basic_amount' => $pricing->basic_amount_ertiga,
                'per_km_price' => $pricing->per_km_price_ertiga,
                'kabby_shares_type' => $pricing->kabby_shares_ertiga,
                'kabby_amount' => $pricing->kabby_amount_ertiga,
            ],
        ];
        
        return response()->json([
            'status' => true,
            'message' => 'Local rides pricing retrieved successfully',
            'data' => $formattedPricing
        ]);
    }
} 