<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /**
     * Register a new driver
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'contact' => 'required|string',
            'additional_contact' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create user with driver role
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'additional_contact' => $request->additional_contact,
            'role' => User::ROLE_DRIVER,
        ]);

        // Generate token for the registered driver
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Driver registered successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->contact,
                'additional_contact' => $user->additional_contact,
                'profile_photo_url' => $user->profile_photo_url,
                'token' => $token
            ]
        ], 201);
    }

    /**
     * Login a driver
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check email exists
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if the user is a driver
        if ($user->role !== User::ROLE_DRIVER) {
            return response()->json([
                'status' => false,
                'message' => 'This account is not registered as a driver'
            ], 403);
        }

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->contact,
                'additional_contact' => $user->additional_contact,
                'profile_photo_url' => $user->profile_photo_url,
                'token' => $token
            ]
        ]);
    }

    /**
     * Get driver profile
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->id);
        
        if (!$user || $user->role !== User::ROLE_DRIVER) {
            return response()->json([
                'status' => false,
                'message' => 'Driver not found or unauthorized access.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->contact,
                'additional_contact' => $user->additional_contact,
                'profile_photo_url' => $user->profile_photo_url
            ]
        ]);
    }

    /**
     * Comprehensive update for driver profile (handles both data and image)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDriverProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'contact' => 'nullable|string',
            'additional_contact' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->id);
        
        if (!$user || $user->role !== User::ROLE_DRIVER) {
            return response()->json([
                'status' => false,
                'message' => 'Driver not found or unauthorized access.'
            ], 404);
        }
        
        // Update user data if provided
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        
        if ($request->has('contact')) {
            $user->contact = $request->contact;
        }
        
        if ($request->has('additional_contact')) {
            $user->additional_contact = $request->additional_contact;
        }

        // Handle profile photo upload if provided
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->contact,
                'additional_contact' => $user->additional_contact,
                'profile_photo_url' => $user->profile_photo_url
            ]
        ]);
    }
} 