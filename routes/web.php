<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes for login and signup
Route::middleware(['guest'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return redirect('login');
    });
    // Login routes
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'signing'])->name('signing');

    // Registration routes
    Route::get('sign-up', [AuthController::class, 'signupView'])->name('signup');
    Route::post('sign-up', [AuthController::class, 'registration'])->name('register');
});



// Route for the dashboard
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return redirect('dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});



