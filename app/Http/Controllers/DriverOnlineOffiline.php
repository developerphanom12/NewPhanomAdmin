<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBankDetail;
use App\Models\PoliceVerification;
use App\Models\DriverLicense;
use App\Models\AadhaarCard;
use App\Models\PollutionVerification;
use App\Models\InsuranceVerification;
use App\Models\VehicleRegistration;
use App\Models\Vehicle;

class DriverOnlineOffiline extends Controller
{
    public function getStatus($userId)
    {
        // Check Bank Detail
        $bankDetail = UserBankDetail::where('user_id', $userId)->first();
        if (!$bankDetail) {
            return response()->json(['is_active' => false,'tab' => 'BD','message' => 'Please submit your bank details'], 200);
        }

        // Check Police Verification
        $policeVerification = PoliceVerification::where('user_id', $userId)->first();
        if (!$policeVerification) {
            return response()->json(['is_active' => false,'tab' => 'PV','message' => 'Please submit your police verification document'], 200);
        }
        if ($policeVerification->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your police verification is not approved yet'], 200);
        }

        // Check Driver License
        $driverLicense = DriverLicense::where('user_id', $userId)->first();
        if (!$driverLicense) {
            return response()->json(['is_active' => false,'tab' => 'DL','message' => 'Please submit your driver license'], 200);
        }
        if ($driverLicense->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your driver license is not approved yet'], 200);
        }

        // Check Aadhaar Card
        $aadhaarCard = AadhaarCard::where('user_id', $userId)->first();
        if (!$aadhaarCard) {
            return response()->json(['is_active' => false,'tab' => 'AC','message' => 'Please submit your Aadhaar card'], 200);
        }
        if ($aadhaarCard->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your Aadhaar card is not approved yet'], 200);
        }

        // Check Pollution Verification
        $pollutionVerification = PollutionVerification::where('user_id', $userId)->first();
        if (!$pollutionVerification) {
            return response()->json(['is_active' => false,'tab' => 'PoV','message' => 'Please submit your pollution verification document'], 200);
        }
        if ($pollutionVerification->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your pollution verification is not approved yet'], 200);
        }

        // Check Insurance Verification
        $insuranceVerification = InsuranceVerification::where('user_id', $userId)->first();
        if (!$insuranceVerification) {
            return response()->json(['is_active' => false,'tab' => 'IV','message' => 'Please submit your insurance verification document'], 200);
        }
        if ($insuranceVerification->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your insurance verification is not approved yet'], 200);
        }

        // Check Vehicle Registration
        $vehicleRegistration = VehicleRegistration::where('user_id', $userId)->first();
        if (!$vehicleRegistration) {
            return response()->json(['is_active' => false,'tab' => 'VR','message' => 'Please submit your vehicle registration document'], 200);
        }
        if ($vehicleRegistration->status !== 'approved') {
            return response()->json(['is_active' => false,'tab' => 'false','message' => 'Your vehicle registration is not approved yet'], 200);
        }

        // Check Vehicle Information
        $vehicleInformation = Vehicle::where('driver_id', $userId)->first();
        if (!$vehicleInformation) {
            return response()->json([
                'is_active' => false,
                'tab' => 'VI',
                'message' => 'Please submit your vehicle information'], 200);
        }

        // If all are present and approved
        return response()->json([
            'user_id' => $userId,
            'tab' => 'false',
            'is_active' => true,
            'message' => 'All documents are submitted and approved'
        ]);
    }
}
