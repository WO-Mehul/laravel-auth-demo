<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function signing(Request $request)
    {
        // Validate the login request data
        $request->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));

        // Attempt to retrieve the user by email
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Attempt to authenticate the user
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // Authentication successful

                // Store the authenticated user's ID in the session
                $request->session()->regenerate();
                $request->session()->put('user_id', Auth::id());

                // Redirect to the intended page after login
                return redirect()->intended('/dashboard');
            } else {
                // Authentication failed

                // Redirect back to the login form with error message
                return back()->withErrors([
                    'password' => 'Invalid Password.',
                ]);
            }
        } else {
            // User not found
            return back()->withErrors([
                'email' => 'User not found.',
            ]);
        }
    }

    public function signupView()
    {
        return view('auth.signup');
    }

    /**
     * Process the user registration.
     */
    public function registration(Request $request)
    {
        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Create a new user instance and save it to the database
        // $userData = $request->only('name', 'email', 'password');
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect the user after successful registration
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }

    public function logout()
    {
        Auth::logout();
        $user = Auth::user();

        // Redirect to the login form after logout
        return redirect('/login');
    }
}
