<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\TestEmailNotification;
use App\Http\Controllers\Auth\DriverAuthController;
use App\Http\Controllers\Auth\PassengerAuthController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\CarpoolController as DriverCarpoolController;
use App\Http\Controllers\Passenger\CarpoolController as PassengerCarpoolController;
use App\Http\Controllers\Driver\PageController as DriverPageController;
use App\Http\Controllers\Passenger\PageController as PassengerPageController;
use App\Models\User;

// 🌟 Welcome Route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 🔐 Password Reset Routes
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// 🚗 Driver Routes
Route::prefix('driver')->group(function () {
    // 🚪 Guest Routes (Login & Register)
    Route::middleware(['guest:driver'])->group(function () {
        Route::get('/login', [DriverAuthController::class, 'showLoginForm'])->name('driver.login');
        Route::post('/login', [DriverAuthController::class, 'login']);
        Route::get('/register', [DriverAuthController::class, 'showRegisterForm'])->name('driver.register');
        Route::post('/register', [DriverAuthController::class, 'register']);
    });

    // 🔐 Authenticated Routes
    Route::middleware(['auth:driver'])->group(function () {
        Route::get('/home', [App\Http\Controllers\Driver\HomeController::class, 'index'])->name('driver.home');
        Route::get('/dashboard', function () { return view('driver.dashboard'); })->name('driver.dashboard');
        Route::post('/logout', [DriverAuthController::class, 'logout'])->name('driver.logout');

        // 👤 Profile
        Route::get('/profile/edit', [DriverController::class, 'edit'])->name('driver.profile.edit');
        Route::put('/profile/update', [DriverController::class, 'update'])->name('driver.profile.update');
        Route::put('/profile/password', [DriverController::class, 'password'])->name('driver.profile.password');


        // 🚘 Vehicle Management
        Route::prefix('vehicle')->group(function () {
            Route::get('/', [CarController::class, 'index'])->name('driver.vehicle.index');
            Route::get('/create', [CarController::class, 'create'])->name('driver.vehicle.create');
            Route::post('/', [CarController::class, 'store'])->name('driver.vehicle.store');
            Route::get('/{car}', [CarController::class, 'show'])->name('driver.vehicle.show');
            Route::get('/{car}/edit', [CarController::class, 'edit'])->name('driver.vehicle.edit');
            Route::put('/{car}', [CarController::class, 'update'])->name('driver.vehicle.update');
            Route::delete('/{car}', [CarController::class, 'destroy'])->name('driver.vehicle.destroy');
        });

        // 🚖 Carpool Management
        Route::prefix('carpool')->group(function () {
            Route::get('/', [DriverCarpoolController::class, 'index'])->name('driver.carpool.index');
            Route::get('/create', [DriverCarpoolController::class, 'create'])->name('driver.carpool.create');
            Route::post('/', [DriverCarpoolController::class, 'store'])->name('driver.carpool.store');
            Route::get('/{carpool}', [DriverCarpoolController::class, 'show'])->name('driver.carpool.show');
            Route::get('/{carpool}/edit', [DriverCarpoolController::class, 'edit'])->name('driver.carpool.edit');
            Route::put('/{carpool}', [DriverCarpoolController::class, 'update'])->name('driver.carpool.update');
            Route::delete('/{carpool}', [DriverCarpoolController::class, 'destroy'])->name('driver.carpool.destroy');
        });

        // 📍 Map
        Route::get('/map', [DriverPageController::class, 'maps'])->name('driver.map.maps');
    });
});

// 🎒 Passenger Routes
Route::prefix('passenger')->group(function () {
    // 🚪 Guest Routes (Login & Register)
    Route::middleware(['guest:passenger'])->group(function () {
        Route::get('/login', [PassengerAuthController::class, 'showLoginForm'])->name('passenger.login');
        Route::post('/login', [PassengerAuthController::class, 'login']);
        Route::get('/register', [PassengerAuthController::class, 'showRegisterForm'])->name('passenger.register');
        Route::post('/register', [PassengerAuthController::class, 'register']);
    });

    // 🔐 Authenticated Routes
    Route::middleware(['auth:passenger'])->group(function () {
        Route::get('/home', [App\Http\Controllers\Passenger\HomeController::class, 'index'])->name('passenger.home');
        Route::get('/dashboard', function () { return view('passenger.dashboard'); })->name('passenger.dashboard');
        Route::post('/logout', [PassengerAuthController::class, 'logout'])->name('passenger.logout');

        // 👤 Profile
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('passenger.profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('passenger.profile.update');
        Route::post('/profile/password', [ProfileController::class, 'password'])->name('passenger.profile.password');

        // 🚖 Carpool Management
        Route::prefix('carpool')->group(function () {
            Route::get('/', [PassengerCarpoolController::class, 'index'])->name('passenger.carpool.index');
            Route::get('/create', [PassengerCarpoolController::class, 'create'])->name('passenger.carpool.create');
            Route::post('/', [PassengerCarpoolController::class, 'store'])->name('passenger.carpool.store');
            Route::get('/{carpool}', [PassengerCarpoolController::class, 'show'])->name('passenger.carpool.show');
            Route::get('/{carpool}/edit', [PassengerCarpoolController::class, 'edit'])->name('passenger.carpool.edit');
            Route::put('/{carpool}', [PassengerCarpoolController::class, 'update'])->name('passenger.carpool.update');
            Route::delete('/{carpool}', [PassengerCarpoolController::class, 'destroy'])->name('passenger.carpool.destroy');
        });

        // 📍 Map
        Route::get('/map', [PassengerPageController::class, 'maps'])->name('passenger.map.maps');
    });
});

// 📧 Test Email Route
Route::get('/send-test-email', function () {
    $user = User::find(1);
    if ($user) {
        $user->notify(new TestEmailNotification());
        return 'Test email sent successfully!';
    }
    return 'User not found.';
});
