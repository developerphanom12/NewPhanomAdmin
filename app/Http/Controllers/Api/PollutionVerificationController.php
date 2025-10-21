<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PollutionVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PollutionVerificationController extends Controller
{
    /**
     * Upload pollution verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPollution(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'pollution_number' => 'required|string',
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
            $frontImagePath = $request->file('front_image')->store('pollution-verifications', 'public');
        }

        // Check if user already has a pollution verification record
        $existingPollution = PollutionVerification::where('user_id', $user->id)->first();
        
        if ($existingPollution) {
            // Delete old image if exists
            if ($existingPollution->front_image_path) {
                Storage::disk('public')->delete($existingPollution->front_image_path);
            }
            
            // Update existing pollution verification
            $existingPollution->pollution_number = $request->pollution_number;
            $existingPollution->front_image_path = $frontImagePath;
            $existingPollution->status = 'pending'; // Reset to pending on update
            $existingPollution->save();
            
            $pollution = $existingPollution;
        } else {
            // Create new pollution verification record
            $pollution = PollutionVerification::create([
                'user_id' => $user->id,
                'pollution_number' => $request->pollution_number,
                'front_image_path' => $frontImagePath,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Pollution verification details uploaded successfully',
            'data' => [
                'id' => $pollution->id,
                'pollution_number' => $pollution->pollution_number,
                'front_image_url' => $pollution->front_image_url,
                'status' => $pollution->status,
            ]
        ], 200);
    }

    /**
     * Get pollution verification details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPollution(Request $request)
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

        $pollution = PollutionVerification::where('user_id', $user->id)->first();
        
        if (!$pollution) {
            return response()->json([
                'status' => false,
                'message' => 'Pollution verification details not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $pollution->id,
                'pollution_number' => $pollution->pollution_number,
                'front_image_url' => $pollution->front_image_url,
                'status' => $pollution->status,
                'remarks' => $pollution->remarks,
            ]
        ], 200);
    }
} 