<?php
namespace App\Http\Controllers;

use App\Models\DriverVehicle;
use Illuminate\Http\Request;

class DriverVehicleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Validate user_id
            'vehicle_number' => 'required|string|unique:driver_vehicles,vehicle_number',
            'registration_date' => 'required|date',
            'vehicle_type' => 'required|string',
            'fuel_type' => 'required|string',
            'vehicle_color' => 'required|string',
            'seat_count' => 'required|integer|min:1',
            'has_carrier' => 'required|boolean',
        ]);

        $vehicle = DriverVehicle::create($validated);

        return response()->json([
            'message' => 'Vehicle registered successfully',
            'data' => $vehicle
        ], 200);
    }
}
