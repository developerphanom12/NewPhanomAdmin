<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:users,id',
            'vehicle_number' => 'required|string|max:20',
            'registration_date' => 'required|date',
            'vehicle_type' => 'required|string',
            'fuel_type' => 'nullable|string',
            'has_carrier' => 'nullable|string',
            'vehicle_color' => 'required|string',
            'seats' => 'required|string',
            'accepted_rules' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $vehicle = Vehicle::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Vehicle information submitted successfully.',
            'data' => $vehicle,
        ]);
    }
    
    public function getVehicle($id){
        $vehicle = Vehicle::where('driver_id',$id)->first();
        return response()->json([
            'status' => true,
            'data' => $vehicle,
        ]);
    }
}
