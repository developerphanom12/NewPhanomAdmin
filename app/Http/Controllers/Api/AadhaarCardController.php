<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AadhaarCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AadhaarCardController extends Controller
{
    /**
     * Upload Aadhaar card details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadAadhaar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'aadhaar_number' => 'required|string',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        // Handle image uploads
        $frontImagePath = null;
        $backImagePath = null;
        
        if ($request->hasFile('front_image')) {
            $frontImagePath = $request->file('front_image')->store('aadhaar-cards', 'public');
        }
        
        if ($request->hasFile('back_image')) {
            $backImagePath = $request->file('back_image')->store('aadhaar-cards', 'public');
        }

        // Check if user already has an Aadhaar card record
        $existingAadhaar = AadhaarCard::where('user_id', $user->id)->first();
        
        if ($existingAadhaar) {
            // Delete old images if they exist
            if ($existingAadhaar->front_image_path) {
                Storage::disk('public')->delete($existingAadhaar->front_image_path);
            }
            
            if ($existingAadhaar->back_image_path) {
                Storage::disk('public')->delete($existingAadhaar->back_image_path);
            }
            
            // Update existing Aadhaar
            $existingAadhaar->aadhaar_number = $request->aadhaar_number;
            $existingAadhaar->front_image_path = $frontImagePath;
            $existingAadhaar->back_image_path = $backImagePath;
            $existingAadhaar->status = 'pending'; // Reset to pending on update
            $existingAadhaar->save();
            
            $aadhaar = $existingAadhaar;
        } else {
            // Create new Aadhaar record
            $aadhaar = AadhaarCard::create([
                'user_id' => $user->id,
                'aadhaar_number' => $request->aadhaar_number,
                'front_image_path' => $frontImagePath,
                'back_image_path' => $backImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Aadhaar card details uploaded successfully',
            'data' => [
                'id' => $aadhaar->id,
                'aadhaar_number' => $aadhaar->aadhaar_number,
                'front_image_url' => $aadhaar->front_image_url,
                'back_image_url' => $aadhaar->back_image_url,
                'status' => $aadhaar->status,
            ]
        ], 200);
    }

    /**
     * Get Aadhaar card details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAadhaar(Request $request)
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

        $aadhaar = AadhaarCard::where('user_id', $user->id)->first();
        
        if (!$aadhaar) {
            return response()->json([
                'status' => false,
                'message' => 'Aadhaar card details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $aadhaar->id,
                'aadhaar_number' => $aadhaar->aadhaar_number,
                'front_image_url' => $aadhaar->front_image_url,
                'back_image_url' => $aadhaar->back_image_url,
                'status' => $aadhaar->status,
                'remarks' => $aadhaar->remarks,
            ]
        ], 200);
    }
} 