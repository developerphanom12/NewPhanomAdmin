<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Register a new user
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'additional_contact' => $request->additional_contact,
            'role' => User::ROLE_USER, // Always create regular users via API
        ]);

        // Generate token for the registered user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'profile_photo_url' => $user->profile_photo_url,
                'token' => $token
            ]
        ], 201);
    }

    /**
     * Login a user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check email exists
        $user = User::where('contact', $request->contact)->first();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if the user is an admin - don't allow admins to log in via the API
        if ($user->role === User::ROLE_ADMIN) {
            return response()->json([
                'status' => false,
                'message' => 'Admin users cannot log in via the mobile app'
            ], 403);
        }


        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    /**
     * Get user by ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserById(Request $request)
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

        $user = User::findOrFail($request->user_id);
        
        // Don't allow fetching admin users
        if ($user->role === User::ROLE_ADMIN) {
            return response()->json([
                'status' => false,
                'message' => 'Access denied'
            ], 403);
        }
        
        return response()->json([
            'status' => true,
            'data' => [
                'user' => $user,
                'profile_photo_url' => $user->profile_photo_url
            ]
        ]);
    }

    /**
     * Update user profile without requiring authentication middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $request->user_id,
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

        $user = User::findOrFail($request->user_id);
        
        // Don't allow updating admin users
        if ($user->role === User::ROLE_ADMIN) {
            return response()->json([
                'status' => false,
                'message' => 'Admin users cannot be updated via the API'
            ], 403);
        }
        
        // Update user data
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        
        if ($request->has('contact')) {
            $user->contact = $request->contact;
        }
        
        if ($request->has('additional_contact')) {
            $user->additional_contact = $request->additional_contact;
        }

        // Handle profile photo upload
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
                'user' => $user,
                'profile_photo_url' => $user->profile_photo_url
            ]
        ]);
    }
} 