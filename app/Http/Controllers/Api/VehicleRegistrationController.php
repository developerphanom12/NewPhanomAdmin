<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VehicleRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class VehicleRegistrationController extends Controller
{
    /**
     * Upload vehicle registration details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'registration_number' => 'required|string',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user_id);
        
        if (!$user || $user->role !== User::ROLE_DRIVER) {
            return response()->json([
                'status' => false,
                'message' => 'User not found or not a driver.'
            ], 404);
        }

        // Handle front image upload
        $frontImagePath = null;
        if ($request->hasFile('front_image')) {
            $frontImagePath = $request->file('front_image')->store('vehicle-registrations', 'public');
        }

        // Check if user already has a vehicle registration record
        $existingRegistration = VehicleRegistration::where('user_id', $user->id)->first();
        
        if ($existingRegistration) {
            // Delete old image if exists
            if ($existingRegistration->front_image_path) {
                Storage::disk('public')->delete($existingRegistration->front_image_path);
            }
            
            // Update existing vehicle registration
            $existingRegistration->registration_number = $request->registration_number;
            $existingRegistration->front_image_path = $frontImagePath;
            $existingRegistration->status = 'pending'; // Reset to pending on update
            $existingRegistration->save();
            
            $registration = $existingRegistration;
        } else {
            // Create new vehicle registration record
            $registration = VehicleRegistration::create([
                'user_id' => $user->id,
                'registration_number' => $request->registration_number,
                'front_image_path' => $frontImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Vehicle registration details uploaded successfully',
            'data' => [
                'id' => $registration->id,
                'registration_number' => $registration->registration_number,
                'front_image_url' => $registration->front_image_url,
                'status' => $registration->status,
            ]
        ], 200);
    }

    /**
     * Get vehicle registration details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user_id);
        
        if (!$user || $user->role !== User::ROLE_DRIVER) {
            return response()->json([
                'status' => false,
                'message' => 'User not found or not a driver.'
            ], 404);
        }

        $registration = VehicleRegistration::where('user_id', $user->id)->first();
        
        if (!$registration) {
            return response()->json([
                'status' => false,
                'message' => 'Vehicle registration details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $registration->id,
                'registration_number' => $registration->registration_number,
                'front_image_url' => $registration->front_image_url,
                'status' => $registration->status,
                'remarks' => $registration->remarks,
            ]
        ], 200);
    }
} 