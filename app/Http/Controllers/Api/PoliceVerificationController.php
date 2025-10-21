<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PoliceVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PoliceVerificationController extends Controller
{
    /**
     * Upload police verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'verification_number' => 'required|string',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

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
            $frontImagePath = $request->file('front_image')->store('police-verifications', 'public');
        }

        // Check if user already has police verification
        $existingVerification = PoliceVerification::where('user_id', $user->id)->first();
        
        if ($existingVerification) {
            // Delete old image if exists
            if ($existingVerification->front_image_path) {
                Storage::disk('public')->delete($existingVerification->front_image_path);
            }
            
            // Update existing verification
            $existingVerification->verification_number = $request->verification_number;
            $existingVerification->front_image_path = $frontImagePath;
            $existingVerification->status = 'pending'; // Reset to pending on update
            $existingVerification->save();
            
            $verification = $existingVerification;
        } else {
            // Create new verification
            $verification = PoliceVerification::create([
                'user_id' => $user->id,
                'verification_number' => $request->verification_number,
                'front_image_path' => $frontImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Police verification details uploaded successfully',
            'data' => [
                'id' => $verification->id,
                'verification_number' => $verification->verification_number,
                'front_image_url' => $verification->front_image_url,
                'status' => $verification->status,
            ]
        ], 200);
    }

    /**
     * Get police verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getVerification(Request $request)
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

        $verification = PoliceVerification::where('user_id', $user->id)->first();
        
        if (!$verification) {
            return response()->json([
                'status' => false,
                'message' => 'Police verification details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $verification->id,
                'verification_number' => $verification->verification_number,
                'front_image_url' => $verification->front_image_url,
                'status' => $verification->status,
                'remarks' => $verification->remarks,
            ]
        ], 200);
    }
} 