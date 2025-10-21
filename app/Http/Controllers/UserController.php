<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RideBooking;

class UserController extends Controller
{
    public function allUsers(){
        $usersData = User::where('role', User::ROLE_USER)->get();
       foreach ($usersData as $user) {
        $user->totalrides = RideBooking::where('user_id', $user->id)->count();
    }
        return view('screen.userlist',compact('usersData'));
    }
    public function userDetails($id){
        $usersData = User::where('id', $id)->get();
        $rides =  RideBooking::where('user_id', $id)->get();
        return view('screen.users.add',compact('usersData','rides'));
    }
}
