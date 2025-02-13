<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\TestEmailNotification;
use App\Http\Controllers\Auth\DriverAuthController;
use App\Http\Controllers\Auth\PassengerAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\CarpoolController as DriverCarpoolController;
use App\Http\Controllers\Passenger\CarpoolController as PassengerCarpoolController;
use App\Http\Controllers\Driver\PageController as DriverPageController;
use App\Http\Controllers\Passenger\PageController as PassengerPageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DriverManagementController;
use App\Http\Controllers\Admin\PassengerManagementController;
use App\Http\Controllers\Passenger\PassengerController;
use App\Http\Controllers\Passenger\BookingController;
use App\Http\Controllers\Driver\BookingRequestController;
use App\Http\Controllers\TelegramBotController;
use App\Models\User;

//welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

use Illuminate\Support\Facades\Session;

Route::get('/home', function () {
    $guard = Session::get('auth_guard');

    if ($guard === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($guard === 'passenger') {
        return redirect()->route('passenger.dashboard');
    } elseif ($guard === 'driver') {
        return redirect()->route('driver.dashboard');
    } 
    return abort(404);
})->name('home');


// Password Reset Routes
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Telegram Bot Webhook
Route::post('/telegram/webhook', [TelegramBotController::class, 'handleWebhook']);

// Driver Routes
Route::prefix('driver')->group(function () {
    // 🚪 Guest Routes (Login & Register)
    Route::middleware(['guest:driver'])->group(function () {
        Route::get('/login', [DriverAuthController::class, 'showLoginForm'])->name('driver.login');
        Route::post('/login', [DriverAuthController::class, 'login']);
        Route::get('/register', [DriverAuthController::class, 'showRegisterForm'])->name('driver.register');
        Route::post('/register', [DriverAuthController::class, 'register']);
    });

    // Authenticated Routes
    Route::middleware(['auth:driver'])->group(function () {
        Route::get('/dashboard', function () { return view('driver.dashboard'); })->name('driver.dashboard');
        Route::post('/logout', [DriverAuthController::class, 'logout'])->name('driver.logout');

        // 👤 Profile
        Route::get('/profile/edit', [DriverController::class, 'edit'])->name('driver.profile.edit');
        Route::put('/profile/update', [DriverController::class, 'update'])->name('driver.profile.update');
        Route::put('/profile/password', [DriverController::class, 'password'])->name('driver.profile.password');


        // Vehicle Management
        Route::prefix('vehicle')->group(function () {
            Route::get('/', [CarController::class, 'index'])->name('driver.vehicle.index');
            Route::get('/create', [CarController::class, 'create'])->name('driver.vehicle.create');
            Route::post('/', [CarController::class, 'store'])->name('driver.vehicle.store');
            Route::get('/{car}', [CarController::class, 'show'])->name('driver.vehicle.show');
            Route::get('/{car}/edit', [CarController::class, 'edit'])->name('driver.vehicle.edit');
            Route::put('/{car}', [CarController::class, 'update'])->name('driver.vehicle.update');
            Route::delete('/{car}', [CarController::class, 'destroy'])->name('driver.vehicle.destroy');
        });

        // Carpool Management
        Route::prefix('carpool')->group(function () {
            Route::get('/', [DriverCarpoolController::class, 'index'])->name('driver.carpool.index');
            Route::get('/create', [DriverCarpoolController::class, 'create'])->name('driver.carpool.create');
            Route::post('/', [DriverCarpoolController::class, 'store'])->name('driver.carpool.store');
            Route::get('/{carpool}', [DriverCarpoolController::class, 'show'])->name('driver.carpool.show');
            Route::get('/{carpool}/edit', [DriverCarpoolController::class, 'edit'])->name('driver.carpool.edit');
            Route::put('/{carpool}', [DriverCarpoolController::class, 'update'])->name('driver.carpool.update');
            Route::delete('/{carpool}', [DriverCarpoolController::class, 'destroy'])->name('driver.carpool.destroy');
        });

        //Booking
        Route::prefix('booking')->group(function () {
            Route::get('/driver/booking', [BookingRequestController::class, 'index'])->name('driver.booking.index');
            Route::post('/driver/booking/{booking}/accept', [BookingRequestController::class, 'accept'])->name('driver.booking.accept');
            Route::post('/driver/booking/{booking}/reject', [BookingRequestController::class, 'reject'])->name('driver.booking.reject');
        });

        // Map
        Route::get('/map', [DriverPageController::class, 'maps'])->name('driver.map.maps');
    });
});

// Passenger Routes
Route::prefix('passenger')->group(function () {
    // 🚪 Guest Routes (Login & Register)
    Route::middleware(['guest:passenger'])->group(function () {
        Route::get('/login', [PassengerAuthController::class, 'showLoginForm'])->name('passenger.login');
        Route::post('/login', [PassengerAuthController::class, 'login']);
        Route::get('/register', [PassengerAuthController::class, 'showRegisterForm'])->name('passenger.register');
        Route::post('/register', [PassengerAuthController::class, 'register']);
    });

    // Authenticated Routes
    Route::middleware(['auth:passenger'])->group(function () {
        Route::get('/home', [App\Http\Controllers\Passenger\HomeController::class, 'index'])->name('passenger.dashboard');
        Route::get('/dashboard', function () { return view('passenger.dashboard'); })->name('passenger.dashboard');
        Route::post('/logout', [PassengerAuthController::class, 'logout'])->name('passenger.logout');

        // Profile
        Route::get('/profile/edit', [PassengerController::class, 'edit'])->name('passenger.profile.edit');
        Route::put('/profile/update', [PassengerController::class, 'update'])->name('passenger.profile.update');
        Route::put('/profile/password', [PassengerController::class, 'password'])->name('passenger.profile.password');

        // Carpool Management
        Route::prefix('carpool')->group(function () {
            Route::get('/', [PassengerCarpoolController::class, 'index'])->name('passenger.carpool.index');
            Route::get('/create', [PassengerCarpoolController::class, 'create'])->name('passenger.carpool.create');
            Route::post('/', [PassengerCarpoolController::class, 'store'])->name('passenger.carpool.store');
            Route::get('/{carpool}', [PassengerCarpoolController::class, 'show'])->name('passenger.carpool.show');
            Route::get('/{carpool}/edit', [PassengerCarpoolController::class, 'edit'])->name('passenger.carpool.edit');
            Route::put('/{carpool}', [PassengerCarpoolController::class, 'update'])->name('passenger.carpool.update');
            Route::delete('/{carpool}', [PassengerCarpoolController::class, 'destroy'])->name('passenger.carpool.destroy');

            //Route::get('/pending/{carpool}', [BookingController::class, 'pending'])->name('passenger.carpool.pending');
            Route::post('/join/{carpool}', [BookingController::class, 'join'])->name('passenger.carpool.join');
            Route::post('/', [BookingController::class, 'store'])->name('passenger.carpool.store');
            Route::put('/booking/{id}/update-status', [BookingController::class, 'updateStatus'])->name('passenger.carpool.updateStatus');
            Route::get('/booking/pending/{carpool}', [BookingController::class, 'pending'])->name('passenger.booking.pending');
        });

        //Incoming Trips
        Route::get('/passenger/incoming-trips', [BookingController::class, 'incomingTrips'])->name('passenger.carpool.trip');
        
        // Map
        Route::get('/map', [PassengerPageController::class, 'maps'])->name('passenger.map.maps');
    });
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // 🚪 Guest Routes (Login & Register)
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });

    // Authenticated Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // 👤 Profile
        Route::get('/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
        Route::post('/profile/password', [AdminController::class, 'password'])->name('admin.profile.password');

        
        //Route::get('/passenger', [PassengerManagementController::class, 'index'])->name('admin.passenger.index'); // undo this to revert changes
        // new edit
        Route::prefix('passenger')->group(function () {
            Route::get('/passenger', [PassengerManagementController::class, 'index'])->name('admin.passenger');
            Route::get('/', [PassengerManagementController::class, 'index'])->name('admin.passenger.index');
            Route::get('/create', [PassengerManagementController::class, 'create'])->name('admin.passenger.create');
            Route::post('/', [PassengerManagementController::class, 'store'])->name('admin.passenger.store');
            Route::get('/{id}', [PassengerManagementController::class, 'show'])->name('admin.passenger.show');
            Route::get('/{passenger}/edit', [PassengerManagementController::class, 'edit'])->name('admin.passenger.edit');
            Route::put('/{passenger}', [PassengerManagementController::class, 'update'])->name('admin.passenger.update');
            Route::delete('/{passenger}', [PassengerManagementController::class, 'destroy'])->name('admin.passenger.destroy');
            Route::patch('/passenger/{id}/suspend', [PassengerManagementController::class, 'suspend'])->name('admin.passenger.suspend');
            // Route::patch('/passenger/{id}/suspend', [PassengerManagementController::class, 'suspend'])->name('admin.passenger.suspend');
            Route::patch('/passenger/{id}/verify-license', [PassengerManagementController::class, 'verifyLicense'])->name('admin.passenger.verify');
            // Route::patch('/passenger/{passenger}/verify-license', [PassengerManagementController::class, 'verifyLicense'])->name('admin.passenger.verify-license');

        });

         // end edit


        Route::prefix('driver')->group(function () {
            Route::get('/driver', [DriverManagementController::class, 'index'])->name('admin.driver');
            Route::get('/', [DriverManagementController::class, 'index'])->name('admin.driver.index');
            Route::get('/create', [DriverManagementController::class, 'create'])->name('admin.driver.create');
            Route::post('/', [DriverManagementController::class, 'store'])->name('admin.driver.store');
            Route::get('/{driver}', [DriverManagementController::class, 'show'])->name('admin.driver.show');
            Route::get('/{id}/edit', [DriverManagementController::class, 'edit'])->name('admin.driver.edit');
            Route::put('/{id}/update', [DriverManagementController::class, 'update'])->name('admin.driver.update');
            Route::delete('/{id}', [DriverManagementController::class, 'destroy'])->name('admin.driver.destroy');
            Route::patch('/driver/{id}/suspend', [DriverManagementController::class, 'suspend'])->name('admin.driver.suspend');
            // Route::patch('/driver/{id}/suspend', [DriverManagementController::class, 'suspend'])->name('admin.driver.suspend');
            Route::patch('/drivers/{id}/verify-license', [DriverController::class, 'verifyLicense'])->name('admin.driver.verify');
            // Route::patch('/drivers/{driver}/verify-license', [DriverController::class, 'verifyLicense'])->name('admin.driver.verify-license');


        });


    });
});

// Test Email Route
Route::get('/send-test-email', function () {
    $user = User::find(1);
    if ($user) {
        $user->notify(new TestEmailNotification());
        return 'Test email sent successfully!';
    }
    return 'User not found.';
});
