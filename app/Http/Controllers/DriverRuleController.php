<?php

namespace App\Http\Controllers;

use App\Models\DriverRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driverRules = DriverRule::all();
        return view('screen.driverrule.index', compact('driverRules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('screen.driverrule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the driver rule
        DriverRule::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => $request->has('is_enabled'),
        ]);

        return redirect()->route('driver-rules.index')
            ->with('success', 'Driver rule created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverRule $driverRule)
    {
        return view('screen.driverrule.show', compact('driverRule'));
    }
    
    public function showRules(){
    
        $driverRules = DriverRule::all();
        
        
        return response()->json([
            'status'=> true,
            'data' => $driverRules
        ], 200);
        
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverRule $driverRule)
    {
        return view('screen.driverrule.edit', compact('driverRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverRule $driverRule)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the driver rule
        $driverRule->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_enabled' => $request->has('is_enabled'),
        ]);

        return redirect()->route('driver-rules.index')
            ->with('success', 'Driver rule updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverRule $driverRule)
    {
        $driverRule->delete();
        
        return redirect()->route('driver-rules.index')
            ->with('success', 'Driver rule deleted successfully!');
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trashed()
    {
        $trashedDriverRules = DriverRule::onlyTrashed()->get();
        return view('screen.driverrule.trashed', compact('trashedDriverRules'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $driverRule = DriverRule::onlyTrashed()->findOrFail($id);
        $driverRule->restore();
        
        return redirect()->route('driver-rules.trashed')
            ->with('success', 'Driver rule restored successfully!');
    }

    /**
     * Permanently delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $driverRule = DriverRule::onlyTrashed()->findOrFail($id);
        $driverRule->forceDelete();
        
        return redirect()->route('driver-rules.trashed')
            ->with('success', 'Driver rule permanently deleted!');
    }
}
