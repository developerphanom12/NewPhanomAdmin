<?php

// app/Http/Controllers/API/UserSOSController.php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSOS;
use Illuminate\Support\Facades\Validator;
use App\Models\RideBooking;
use App\Models\Vehicle;

class UserSOSController extends Controller
{
    public function sendSOS(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'ride_id' => 'required|exists:ride_bookings,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $sos = UserSOS::create([
            'user_id' => $request->user_id,
            'ride_id' => $request->ride_id,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'SOS sent successfully.',
            'data' => $sos
        ]);
    }
    
    public function showSOS(){
        $sos = UserSOS::All();
        return view('screen.sos.sos',compact('sos'));
    }
    
    public function showSOSEdit($id){
          $sos = UserSOS::where('id',$id)->first();
        $user = User::where('id',$sos->user_id)->first();
        $ride = RideBooking::where('id',$sos->ride_id)->first();
        $driverID = $ride->driver_id;
        $driver = User::where('id',$driverID)->first();
        $vehicle = Vehicle::where('driver_id',$driverID)->first();
        return view('screen.sos.editsos',compact('user','ride','driver','vehicle'));
    }
}
