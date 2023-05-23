<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID from the session
        $userId = session('user_id');
        
        // Retrieve the user record from the database
        $user = User::find($userId);

        // Retrieve the user's name
        $userName = $user->name;

        // Total number of users
        $totalUsers = User::count();

        // Count of users grouped by role
       // Count of users grouped by role
       $usersByRole = Role::withCount('users')->get();

        // Count of users created each month in the last year
        $usersByMonth = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->get();

        // Average number of users created per day in the last month
        $averageUsersPerDay = User::where('created_at', '>=', now()->subMonth())
            ->count() / 30;


        return view('dashboard', compact('userName', 'totalUsers', 'usersByRole', 'usersByMonth', 'averageUsersPerDay'));
    }
}
