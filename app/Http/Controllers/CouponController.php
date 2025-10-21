<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('screen.coupons.allcoupon', compact('coupons'));
    }

    public function create()
    {
        return view('screen.coupons.createcoupon');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fixed,percentage',
            'amount' => 'required|numeric|min:0',
            'coupon_code' => 'required|string|max:255|unique:coupons,coupon_code',
            'validity' => 'required|date',
            'is_enabled' => 'nullable|boolean',
            'is_public' => 'nullable|boolean',
        ]);
        $validated['is_enabled'] = $request->has('is_enabled');
        $validated['is_public'] = $request->has('is_public');
        Coupon::create($validated);
        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('screen.coupons.editcoupon', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:fixed,percentage',
            'amount' => 'required|numeric|min:0',
            'coupon_code' => 'required|string|max:255|unique:coupons,coupon_code,' . $coupon->id,
            'validity' => 'required|date',
            'is_enabled' => 'nullable|boolean',
            'is_public' => 'nullable|boolean',
        ]);
        $validated['is_enabled'] = $request->has('is_enabled');
        $validated['is_public'] = $request->has('is_public');
        $coupon->update($validated);
        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
} 