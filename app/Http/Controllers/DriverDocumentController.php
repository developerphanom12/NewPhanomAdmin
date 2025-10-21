<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PoliceVerification;
use App\Models\DriverLicense;
use App\Models\AadhaarCard;
use App\Models\PollutionVerification;
use App\Models\InsuranceVerification;
use App\Models\VehicleRegistration;
use Illuminate\Http\Request;

class DriverDocumentController extends Controller
{
    /**
     * Display all drivers (both active and inactive)
     */
    public function allDrivers()
    {
        $drivers = User::where('role', User::ROLE_DRIVER)->get();
        
        // Process each driver to determine if they are active (all documents verified)
        $drivers->map(function($driver) {
            $driver->is_active = $this->isDriverActive($driver->id);
            return $driver;
        });
        
        return view('screen.drivers.alldrivers', compact('drivers'));
    }
    
    /**
     * Display only approved drivers (all documents verified)
     */
    public function approvedDrivers()
    {
        $drivers = User::where('role', User::ROLE_DRIVER)->get()
            ->filter(function($driver) {
                return $this->isDriverActive($driver->id);
            })
            ->values();
        
        return view('screen.drivers.approvedriver', compact('drivers'));
    }
    
    /**
     * Display drivers with pending approvals
     */
    public function pendingDrivers()
    {
        $drivers = User::where('role', User::ROLE_DRIVER)->get()
            ->filter(function($driver) {
                return !$this->isDriverActive($driver->id);
            })
            ->values();
        
        return view('screen.drivers.approvepending', compact('drivers'));
    }
    
    /**
     * Show driver document details
     */
    public function showDriverDocuments($id)
    {
        $driver = User::findOrFail($id);
        
        // Ensure the user is a driver
        if ($driver->role !== User::ROLE_DRIVER) {
            return redirect()->back()->with('error', 'User is not a driver');
        }
        
        // Get all documents for this driver
        $documents = [
            'police_verification' => PoliceVerification::where('user_id', $driver->id)->first(),
            'driver_license' => DriverLicense::where('user_id', $driver->id)->first(),
            'aadhaar_card' => AadhaarCard::where('user_id', $driver->id)->first(),
            'pollution_verification' => PollutionVerification::where('user_id', $driver->id)->first(),
            'insurance_verification' => InsuranceVerification::where('user_id', $driver->id)->first(),
            'vehicle_registration' => VehicleRegistration::where('user_id', $driver->id)->first(),
        ];
        
        return view('screen.drivers.alldriver.document', compact('driver', 'documents'));
    }
    
    /**
     * Update document approval status
     */
    public function updateDocumentStatus(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'document_id' => 'required|integer',
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string'
        ]);
        
        $model = null;
        
        // Determine which model to update based on document_type
        switch($request->document_type) {
            case 'police_verification':
                $model = PoliceVerification::findOrFail($request->document_id);
                break;
            case 'driver_license':
                $model = DriverLicense::findOrFail($request->document_id);
                break;
            case 'aadhaar_card':
                $model = AadhaarCard::findOrFail($request->document_id);
                break;
            case 'pollution_verification':
                $model = PollutionVerification::findOrFail($request->document_id);
                break;
            case 'insurance_verification':
                $model = InsuranceVerification::findOrFail($request->document_id);
                break;
            case 'vehicle_registration':
                $model = VehicleRegistration::findOrFail($request->document_id);
                break;
            default:
                return redirect()->back()->with('error', 'Invalid document type');
        }
        
        $model->status = $request->status;
        $model->remarks = $request->remarks;
        $model->save();
        
        return redirect()->back()->with('success', 'Document status updated successfully');
    }
    
    /**
     * Check if all driver documents are approved
     */
    private function isDriverActive($userId)
    {
        // Check if all documents exist and are approved
        $policeVerification = PoliceVerification::where('user_id', $userId)->first();
        $driverLicense = DriverLicense::where('user_id', $userId)->first();
        $aadhaarCard = AadhaarCard::where('user_id', $userId)->first();
        $pollutionVerification = PollutionVerification::where('user_id', $userId)->first();
        $insuranceVerification = InsuranceVerification::where('user_id', $userId)->first();
        $vehicleRegistration = VehicleRegistration::where('user_id', $userId)->first();
        
        // If any document doesn't exist or is not approved, driver is not active
        if (!$policeVerification || $policeVerification->status !== 'approved') return false;
        if (!$driverLicense || $driverLicense->status !== 'approved') return false;
        if (!$aadhaarCard || $aadhaarCard->status !== 'approved') return false;
        if (!$pollutionVerification || $pollutionVerification->status !== 'approved') return false;
        if (!$insuranceVerification || $insuranceVerification->status !== 'approved') return false;
        if (!$vehicleRegistration || $vehicleRegistration->status !== 'approved') return false;
        
        return true;
    }
} 