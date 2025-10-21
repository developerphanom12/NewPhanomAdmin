<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOTP;

class UserOTPController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ride_id' => 'required|integer',
            'otp' => 'required|string|max:10',
        ]);

        $otp = UserOTP::create([
            'ride_id' => $request->ride_id,
            'otp' => $request->otp,
        ]);

        return response()->json([
            'message' => 'OTP saved successfully',
            'data' => $otp
        ], 200);
    }
    
    public function getOTP(Request $request){
        $request->validate([
            'ride_id' => 'required|integer',
            'otp' => 'required|integer',
        ]);
        $otp=UserOTP::where('ride_id',$request->ride_id)->first();
        
        if($otp->otp == $request->otp)
        return response()->json([
            'message' => 'OTP matched successfully',
            'iscorrect' => true
        ], 200);
        else {
            return response()->json([
            'message' => 'OTP matching failed',
            'iscorrect' => false
        ]);
        }
    }
    
    public function getUserOTP(Request $request){
        $request->validate([
            'ride_id' => 'required|integer',
        ]);
        $otp=UserOTP::where('ride_id',$request->ride_id)->first();
        return response()->json([
            'status' => true,
            'otp' => $otp->otp
        ], 200);
    }
}
