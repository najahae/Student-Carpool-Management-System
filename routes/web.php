<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\TestEmailNotification;
use App\Http\Controllers\Auth\DriverAuthController;
use App\Http\Controllers\Auth\PassengerAuthController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\Driver\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\Driver\HomeController@index')->name('home')->middleware('auth');

// Password Confirmation Routes
Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

// Forgot Password Routes
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password Routes
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');


//Driver
Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\Driver\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\Driver\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\Driver\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\Driver\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\Driver\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\Driver\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\Driver\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	//Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'driver.profile.edit', 'uses' => 'App\Http\Controllers\Driver\DriverController@edit']);
	Route::put('profile', ['as' => 'driver.profile.update', 'uses' => 'App\Http\Controllers\Driver\DriverController@update']);
	Route::put('profile/password', ['as' => 'driver.profile.password', 'uses' => 'App\Http\Controllers\Driver\DriverController@password']);
});

// Driver Routes
Route::prefix('driver')->group(function () {
    Route::middleware(['guest:driver'])->group(function () {
        Route::get('/login', [DriverAuthController::class, 'showLoginForm'])->name('driver.login');
        Route::post('/login', [DriverAuthController::class, 'login']);
        Route::get('/register', [DriverAuthController::class, 'showRegisterForm'])->name('driver.register');
        Route::post('/register', [DriverAuthController::class, 'register']);
    });

    Route::middleware('auth:driver')->group(function () {
        Route::post('/logout', [DriverAuthController::class, 'logout'])->name('driver.logout');
        Route::get('/dashboard', function () {
            return view('driver.dashboard');
        })->name('driver.dashboard');
    });
});

// Passenger Routes
Route::prefix('passenger')->group(function () {
    Route::middleware(['guest:passenger'])->group(function () {
        Route::get('/login', [PassengerAuthController::class, 'showLoginForm'])->name('passenger.login');
        Route::post('/login', [PassengerAuthController::class, 'login']);
        Route::get('/register', [PassengerAuthController::class, 'showRegisterForm'])->name('passenger.register');
        Route::post('/register', [PassengerAuthController::class, 'register']);
    });

    Route::middleware('auth:passenger')->group(function () {
        Route::post('/logout', [PassengerAuthController::class, 'logout'])->name('passenger.logout');
        Route::get('/dashboard', function () {
            return view('passenger.dashboard');
        })->name('passenger.dashboard');
    });
});


//Vehicle routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/vehicle', ['as' => 'driver.vehicle.index', 'uses' => 'App\Http\Controllers\Driver\CarController@index']);
	Route::get('/vehicle/create', ['as' => 'driver.vehicle.create', 'uses' => 'App\Http\Controllers\Driver\CarController@create']);
	Route::post('/vehicle', ['as' => 'driver.vehicle.store', 'uses' => 'App\Http\Controllers\Driver\CarController@store']);
	Route::get('/vehicle/{car}', ['as' => 'driver.vehicle.show', 'uses' => 'App\Http\Controllers\Driver\CarController@show']);
	Route::get('/vehicle/{car}/edit', ['as' => 'driver.vehicle.edit', 'uses' => 'App\Http\Controllers\Driver\CarController@edit']);
	Route::put('/vehicle/{car}', ['as' => 'driver.vehicle.update', 'uses' => 'App\Http\Controllers\Driver\CarController@update']);
	Route::delete('/vehicle/{car}', ['as' => 'driver.vehicle.destroy', 'uses' => 'App\Http\Controllers\Driver\CarController@destroy']);
});

//Carpool routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/carpool', ['as' => 'driver.carpool.index', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@index']);
	Route::get('/carpool/create', ['as' => 'driver.carpool.create', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@create']);
	Route::post('/carpool', ['as' => 'driver.carpool.store', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@store']);
	Route::get('/carpool/{carpool}', ['as' => 'driver.carpool.show', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@show']);
	Route::get('/carpool/{carpool}/edit', ['as' => 'driver.carpool.edit', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@edit']);
	Route::put('/carpool/{carpool}', ['as' => 'driver.carpool.update', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@update']);
	Route::delete('/carpool/{carpool}', ['as' => 'driver.carpool.destroy', 'uses' => 'App\Http\Controllers\Driver\CarpoolController@destroy']);
});

Route::get('/send-test-email', function () {
    // Replace 1 with an existing user's ID in your database
    $user = User::find(1); 

    if ($user) {
        $user->notify(new TestEmailNotification());
        return 'Test email sent successfully!';
    }

    return 'User not found.';
});