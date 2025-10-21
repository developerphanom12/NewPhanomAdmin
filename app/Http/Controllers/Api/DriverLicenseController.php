<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DriverLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DriverLicenseController extends Controller
{
    /**
     * Upload driver license details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadLicense(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'license_number' => 'required|string',
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
            $frontImagePath = $request->file('front_image')->store('driver-licenses', 'public');
        }

        // Check if user already has a driver license record
        $existingLicense = DriverLicense::where('user_id', $user->id)->first();
        
        if ($existingLicense) {
            // Delete old image if exists
            if ($existingLicense->front_image_path) {
                Storage::disk('public')->delete($existingLicense->front_image_path);
            }
            
            // Update existing license
            $existingLicense->license_number = $request->license_number;
            $existingLicense->front_image_path = $frontImagePath;
            $existingLicense->status = 'pending'; // Reset to pending on update
            $existingLicense->save();
            
            $license = $existingLicense;
        } else {
            // Create new license record
            $license = DriverLicense::create([
                'user_id' => $user->id,
                'license_number' => $request->license_number,
                'front_image_path' => $frontImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Driver license details uploaded successfully',
            'data' => [
                'id' => $license->id,
                'license_number' => $license->license_number,
                'front_image_url' => $license->front_image_url,
                'status' => $license->status,
            ]
        ], 200);
    }

    /**
     * Get driver license details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getLicense(Request $request)
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

        $license = DriverLicense::where('user_id', $user->id)->first();
        
        if (!$license) {
            return response()->json([
                'status' => false,
                'message' => 'Driver license details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $license->id,
                'license_number' => $license->license_number,
                'front_image_url' => $license->front_image_url,
                'status' => $license->status,
                'remarks' => $license->remarks,
            ]
        ], 200);
    }
} 