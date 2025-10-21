<?php

namespace App\Http\Controllers;

use App\Models\IntraCityCosting;
use Illuminate\Http\Request;

class LocalRidesController extends Controller
{
    /**
     * Display the form to create or update local ride pricing.
     */
    public function create()
    {
        $pricing = IntraCityCosting::where('is_active', true)->first();
        $isEdit = false;

        return view('screen.destination.localRides.create', compact('pricing', 'isEdit'));
    }

    /**
     * Display the form to edit local ride pricing.
     */
    public function edit()
    {
        $pricing = IntraCityCosting::where('is_active', true)->first();
        $isEdit = true;

        return view('screen.destination.localRides.create', compact('pricing', 'isEdit'));
    }

    /**
     * Store a newly created local ride pricing.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // Moto
            'basic_amount_moto' => 'required|numeric|min:0',
            'per_km_price_moto' => 'required|numeric|min:0',
            'kabby_shares_moto' => 'required|in:percentage,fixed',
            'kabby_amount_moto' => 'required|numeric|min:0',
            
            // Mini
            'basic_amount_mini' => 'required|numeric|min:0',
            'per_km_price_mini' => 'required|numeric|min:0',
            'kabby_shares_mini' => 'required|in:percentage,fixed',
            'kabby_amount_mini' => 'required|numeric|min:0',
            
            // Sedan
            'basic_amount_sedan' => 'required|numeric|min:0',
            'per_km_price_sedan' => 'required|numeric|min:0',
            'kabby_shares_sedan' => 'required|in:percentage,fixed',
            'kabby_amount_sedan' => 'required|numeric|min:0',
            
            // Ertiga
            'basic_amount_ertiga' => 'required|numeric|min:0',
            'per_km_price_ertiga' => 'required|numeric|min:0',
            'kabby_shares_ertiga' => 'required|in:percentage,fixed',
            'kabby_amount_ertiga' => 'required|numeric|min:0',
        ]);

        // Set all existing records to inactive
        IntraCityCosting::where('is_active', true)->update(['is_active' => false]);
        
        // Create new pricing record
        IntraCityCosting::create($validatedData + ['is_active' => true]);

        return redirect()->route('local-rides.create')
            ->with('success', 'Local ride pricing has been created successfully.');
    }

    /**
     * Update the specified local ride pricing.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            // Moto
            'basic_amount_moto' => 'required|numeric|min:0',
            'per_km_price_moto' => 'required|numeric|min:0',
            'kabby_shares_moto' => 'required|in:percentage,fixed',
            'kabby_amount_moto' => 'required|numeric|min:0',
            
            // Mini
            'basic_amount_mini' => 'required|numeric|min:0',
            'per_km_price_mini' => 'required|numeric|min:0',
            'kabby_shares_mini' => 'required|in:percentage,fixed',
            'kabby_amount_mini' => 'required|numeric|min:0',
            
            // Sedan
            'basic_amount_sedan' => 'required|numeric|min:0',
            'per_km_price_sedan' => 'required|numeric|min:0',
            'kabby_shares_sedan' => 'required|in:percentage,fixed',
            'kabby_amount_sedan' => 'required|numeric|min:0',
            
            // Ertiga
            'basic_amount_ertiga' => 'required|numeric|min:0',
            'per_km_price_ertiga' => 'required|numeric|min:0',
            'kabby_shares_ertiga' => 'required|in:percentage,fixed',
            'kabby_amount_ertiga' => 'required|numeric|min:0',
        ]);

        // Set all existing records to inactive
        IntraCityCosting::where('is_active', true)->update(['is_active' => false]);
        
        // Create new pricing record
        IntraCityCosting::create($validatedData + ['is_active' => true]);

        return redirect()->route('local-rides.create')
            ->with('success', 'Local ride pricing has been updated successfully.');
    }
}
