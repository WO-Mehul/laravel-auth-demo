<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        return view('dashboard', compact('userName'));
    }
}
