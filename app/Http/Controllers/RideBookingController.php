<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBankDetail;
use App\Models\RideBooking;
use App\Models\User;
use App\Models\PoliceVerification;
use App\Models\DriverLicense;
use App\Models\AadhaarCard;
use App\Models\PollutionVerification;
use App\Models\InsuranceVerification;
use App\Models\VehicleRegistration;
use App\Models\DriverVehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class RideBookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
    'user_id' => 'required|exists:users,id',
    'vehicle_type' => 'required|string',
    'boarding_point' => 'required|string',
    'destination_point' => 'required|string',
    'carrier_required' => 'required|boolean',
    'alternate_contact' => 'nullable|string',
    'ac_required' => 'required|boolean',
    'booking_amount' => 'required|numeric|min:0',
    'commission' => 'required|numeric|min:0',
    'total_driver_payment' => 'required|numeric|min:0',
    'distance' => 'required|integer|min:0',
    'pickup_date' => 'required|date',
    'pickup_time' => 'required|date_format:H:i',
    'payment_method' => 'required|in:wallet,razorpay',
]);


        $booking = RideBooking::create($validated);

        return response()->json([
            'message' => 'Ride booked successfully.',
            'data' => $booking
        ], 200);
    }

   public function showRides()
{
    $ridesDetails = DB::table('ride_bookings')
        ->leftJoin('users as u', 'ride_bookings.user_id', '=', 'u.id')
        ->leftJoin('users as d', 'ride_bookings.driver_id', '=', 'd.id') // only if driver_id exists
        ->select(
            'ride_bookings.id as ride_id',
            'u.name as user_name',
            'd.name as driver_name',
            'ride_bookings.created_at',
            'ride_bookings.booking_amount'
        )
        ->get()
        ->map(function ($ride) {
            return [
                'ride_id' => $ride->ride_id,
                'user_name' => $ride->user_name ?? 'N/A',
                'driver_name' => $ride->driver_name ?? 'Not Assigned',
                'created_at' => \Carbon\Carbon::parse($ride->created_at)->format('d M, Y | g:i A'),
                'booking_amount' => $ride->booking_amount,
            ];
        });
    
    
    return view('screen.rides.intercity', compact('ridesDetails'));
}


public function showRidesView($id)
{
    $ridesDetails = DB::table('ride_bookings')->where('id', $id)->first();
    $user = User::find($ridesDetails->user_id);
    $ApprovedDriver;
    // Get assigned driver IDs for this ride
    $assignedDriverIds = DB::table('ride_driver')
        ->where('ride_id', $id)
        ->pluck('driver_id')
        ->toArray();
    if($ridesDetails->driver_id)
    $ApprovedDriver=User::find($ridesDetails->driver_id);
    
    // Get all eligible drivers (including those already assigned)
    $drivers = User::whereHas('bankDetail')
        ->whereHas('policeVerification', fn($q) => $q->where('status', 'approved'))
        ->whereHas('driverLicense', fn($q) => $q->where('status', 'approved'))
        ->whereHas('aadhaarCard', fn($q) => $q->where('status', 'approved'))
        ->whereHas('pollutionVerification', fn($q) => $q->where('status', 'approved'))
        ->whereHas('insuranceVerification', fn($q) => $q->where('status', 'approved'))
        ->whereHas('vehicleRegistration', fn($q) => $q->where('status', 'approved'))
        ->whereHas('driverVehicle')
        ->select('id as user_id', 'name')
        ->get();
    
    if($ridesDetails->driver_id)
    return view('screen.rides.rideDetail', compact('ridesDetails', 'user', 'drivers', 'assignedDriverIds','ApprovedDriver'));
    else {
    return view('screen.rides.rideDetail', compact('ridesDetails', 'user', 'drivers', 'assignedDriverIds'));
    }
}


public function getUserRides($user_id)
{
    $baseUrl = URL::to('/'); // Get base URL like https://yourdomain.com

    $ridesDetails = DB::table('ride_bookings')
        ->leftJoin('users', function ($join) {
            $join->on('ride_bookings.driver_id', '=', 'users.id')
                 ->whereNotNull('ride_bookings.driver_id');
        })
        ->where('ride_bookings.user_id', $user_id)
        ->select(
            'ride_bookings.*',
            'users.name as driver_name',
            DB::raw("CONCAT('$baseUrl/storage/', users.profile_photo_path) as driver_profile_photo")
        )
        ->get();

    return response()->json([
        'status' => true,
        'data' => $ridesDetails
    ], 200);
}


public function getUserLastRide($user_id)
{
    $baseUrl = URL::to('/'); // Get base URL like https://yourdomain.com

    $lastRide = DB::table('ride_bookings')
        ->leftJoin('users', function ($join) {
            $join->on('ride_bookings.driver_id', '=', 'users.id')
                 ->whereNotNull('ride_bookings.driver_id');
        })
        ->leftJoin('vehicles', 'ride_bookings.driver_id', '=', 'vehicles.driver_id')
        ->where('ride_bookings.user_id', $user_id)
        ->where('ride_bookings.ride_status', 3) // Only completed rides
        ->orderByDesc('ride_bookings.created_at') // Or use 'id' if no timestamps
        ->select(
            'ride_bookings.*',
            'users.name as driver_name',
            DB::raw("CONCAT('$baseUrl/storage/', users.profile_photo_path) as driver_profile_photo"),
            'vehicles.vehicle_type',
            'vehicles.seats'
        )
        ->first();

    return response()->json([
        'status' => $lastRide ? true : false,
        'data' => $lastRide
    ], 200);
}






public function updateStatus(Request $request, $id)
{
    $validated = $request->validate([
        'ride_status' => 'required|int|in:1,2,3,4'
    ]);

    $booking = RideBooking::find($id);

    if (!$booking) {
        return response()->json([
            'message' => 'Ride not found.'
        ], 404);
    }

    $booking->ride_status = $validated['ride_status'];
    $booking->save();

    return response()->json([
        'message' => 'Status updated successfully.',
        'data' => $booking
    ], 200);
}


}
