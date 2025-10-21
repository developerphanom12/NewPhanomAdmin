<?php

namespace App\Http\Controllers;

use App\Models\UserBankDetail;
use Illuminate\Http\Request;

class UserBankDetailController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bank_name' => 'required|string',
            'branch_name' => 'required|string',
            'holder_name' => 'required|string',
            'account_number' => 'required|string|unique:user_bank_details',
            'ifsc_code' => 'required|string',
        ]);

        // Create the bank detail
        $bankDetail = UserBankDetail::create($validated);
        // Return success response
        return response()->json([
            'message' => 'Bank details submitted successfully',
            'data' => $bankDetail
        ], 200);
    }
    
    public function getDetails($id){
        $bankDetail = UserBankDetail::where('user_id',$id)->first();
        return response()->json([
            'status'=> true,
            'data' => $bankDetail
        ], 200);
    }
}
