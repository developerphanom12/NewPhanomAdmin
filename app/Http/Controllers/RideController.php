<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RideBooking;
use Illuminate\Support\Facades\DB;
class RideController extends Controller
{
   public function assignDrivers(Request $request, $rideId)
{
    $newDriverIds = $request->input('driver_ids', []);

    // Get already assigned drivers
    $alreadyAssigned = DB::table('ride_driver')
        ->where('ride_id', $rideId)
        ->pluck('driver_id')
        ->toArray();

    // Combine existing and new drivers (unique)
    $allDriversToAssign = array_unique(array_merge($alreadyAssigned, $newDriverIds));

    // Sync without removing old ones
    // You can insert only new ones manually:
    foreach ($allDriversToAssign as $driverId) {
        DB::table('ride_driver')->updateOrInsert(
            ['ride_id' => $rideId, 'driver_id' => $driverId],
            ['created_at' => now(), 'updated_at' => now()]
        );
    }

    return redirect()->back()->with('success', 'Drivers assigned successfully!');
}



public function getDriverRides($driverId)
{
    // Fetch rides assigned to the given driver
    $rides = DB::table('ride_bookings')
        ->join('ride_driver', 'ride_bookings.id', '=', 'ride_driver.ride_id')
        ->where('ride_driver.driver_id', $driverId)
        ->select('ride_bookings.*')
        ->get();

    return response()->json([
        'status' => true,
        'message' => 'Rides fetched successfully',
        'data' => $rides
    ]);
}

public function getDriverActiveRides($driver_id)
{
    $rides = DB::table('ride_bookings')
        ->where('ride_bookings.driver_id', $driver_id)
        ->join('users', 'ride_bookings.user_id', '=', 'users.id')
        ->select(
            'ride_bookings.*',
            'users.name as user_name',
            'users.profile_photo_path as user_profile'
        )
        ->get();

    // Append full URL to profile photo
    $rides->transform(function ($ride) {
        $ride->user_profile = $ride->user_profile 
            ? url('storage/' . $ride->user_profile)
            : null;
        return $ride;
    });

    return response()->json([
        'status' => true,
        'message' => 'Rides fetched successfully',
        'data' => $rides
    ]);
}



public function acceptRideByDrivers($ride_id, $driver_id)
{
    try {
        // Begin transaction
        DB::beginTransaction();

        // 1. Update ride_bookings table: set driver_id and ride_status
        DB::table('ride_bookings')
            ->where('id', $ride_id)
            ->update([
                'driver_id' => $driver_id,
                'ride_status' => 1
            ]);

        // 2. Delete all entries in ride_driver for the given ride_id
        DB::table('ride_driver')
            ->where('ride_id', $ride_id)
            ->delete();

        // Commit transaction
        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Ride accepted and updated successfully.',
        ]);
    } catch (\Exception $e) {
        // Rollback on error
        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}
}
