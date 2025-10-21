<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    // Register (simplified, we'll create user with password)
    public function register(Request $req){
        $data = $req->validate([
            'name'=>'required|string|max:120',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'ok'=>true,
            'user'=>$user,
            'token'=>$token
        ],201);
    }

    // Login
    public function login(Request $req){
        $data = $req->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            throw ValidationException::withMessages(['email'=>'The provided credentials are incorrect.']);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        // include profile info
        $profile = $user->freelancerProfile ?? null;

        return response()->json([
            'ok'=>true,
            'user'=>$user,
            'profile'=>$profile,
            'token'=>$token,
        ]);
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        return response()->json(['ok'=>true]);
    }
}
