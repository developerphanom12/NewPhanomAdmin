<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get today's statistics
        $today = Carbon::today();
        $todayUsers = User::where('role', User::ROLE_USER)
                        ->whereDate('created_at', $today)
                        ->count();
        
        // Get total statistics
        $totalUsers = User::where('role', User::ROLE_USER)->count();
        
        return view('dashboard', compact('todayUsers', 'totalUsers'));
    }
} 