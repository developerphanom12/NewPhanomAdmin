<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\InsuranceVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class InsuranceVerificationController extends Controller
{
    /**
     * Upload insurance verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadInsurance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'insurance_number' => 'required|string',
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
            $frontImagePath = $request->file('front_image')->store('insurance-verifications', 'public');
        }

        // Check if user already has an insurance verification record
        $existingInsurance = InsuranceVerification::where('user_id', $user->id)->first();
        
        if ($existingInsurance) {
            // Delete old image if exists
            if ($existingInsurance->front_image_path) {
                Storage::disk('public')->delete($existingInsurance->front_image_path);
            }
            
            // Update existing insurance verification
            $existingInsurance->insurance_number = $request->insurance_number;
            $existingInsurance->front_image_path = $frontImagePath;
            $existingInsurance->status = 'pending'; // Reset to pending on update
            $existingInsurance->save();
            
            $insurance = $existingInsurance;
        } else {
            // Create new insurance verification record
            $insurance = InsuranceVerification::create([
                'user_id' => $user->id,
                'insurance_number' => $request->insurance_number,
                'front_image_path' => $frontImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Insurance verification details uploaded successfully',
            'data' => [
                'id' => $insurance->id,
                'insurance_number' => $insurance->insurance_number,
                'front_image_url' => $insurance->front_image_url,
                'status' => $insurance->status,
            ]
        ], 200);
    }

    /**
     * Get insurance verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getInsurance(Request $request)
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

        $insurance = InsuranceVerification::where('user_id', $user->id)->first();
        
        if (!$insurance) {
            return response()->json([
                'status' => false,
                'message' => 'Insurance verification details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $insurance->id,
                'insurance_number' => $insurance->insurance_number,
                'front_image_url' => $insurance->front_image_url,
                'status' => $insurance->status,
                'remarks' => $insurance->remarks,
            ]
        ], 200);
    }
} 