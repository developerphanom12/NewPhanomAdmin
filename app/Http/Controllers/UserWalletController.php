<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;

class UserWalletController extends Controller
{
    public function getBalance($user_id){
        $user = User::where('id',$user_id)->first();
        if ($user) {
        $wallet = $user->wallet;
        return response()->json([
                'status' => true,
                'wallet' => $wallet,
            ], 200);
    } else {
         return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
    }
    }
    
    public function addToWallet(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'transaction_detail' => 'required|string|max:255',
        'transaction_amount' => 'required|numeric|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Find the user
    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 404);
    }

    // Start transaction to ensure both updates succeed together
    \DB::beginTransaction();
    try {
        // Create the transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_detail' => $request->transaction_detail,
            'transaction_type' => 'credit',
            'transaction_amount' => $request->transaction_amount,
        ]);

        // Update wallet balance
        $user->wallet += $request->transaction_amount;
        $user->save();

        \DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Amount added to wallet successfully.',
            'wallet_balance' => $user->wallet,
            'data' => $transaction
        ]);

    } catch (\Exception $e) {
        \DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}








public function debitFromWallet(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'transaction_detail' => 'required|string|max:255',
        'transaction_amount' => 'required|numeric|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Find the user
    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 404);
    }

    // Check if wallet has enough balance
    if ($user->wallet < $request->transaction_amount) {
        return response()->json([
            'status' => false,
            'message' => 'Insufficient wallet balance',
        ], 400);
    }

    \DB::beginTransaction();
    try {
        // Create debit transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'transaction_detail' => $request->transaction_detail,
            'transaction_type' => 'debit',
            'transaction_amount' => $request->transaction_amount,
        ]);

        // Subtract amount from wallet
        $user->wallet -= $request->transaction_amount;
        $user->save();

        \DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Amount debited from wallet successfully.',
            'wallet_balance' => $user->wallet,
            'data' => $transaction
        ]);

    } catch (\Exception $e) {
        \DB::rollBack();
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}




public function getTransaction($user_id)
{
    // Check if user exists
    $user = User::find($user_id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User not found',
        ], 404);
    }

    // Fetch all transactions for the user ordered by latest first
    $transactions = Transaction::where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return response()->json([
        'status' => true,
        'transactions' => $transactions,
    ]);
}

    
}
