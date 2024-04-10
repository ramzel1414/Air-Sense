<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirQualityDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollutantController;
use App\Http\Controllers\LocationController;

use App\Http\Controllers\PdfController;



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

Route::get('/location', function () {
    return view('location');
})->name('location');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// protect route -> user can't access admin
Route::middleware(['auth', 'role:admin'])->group(function() {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::get('/admin/management', [AdminController::class, 'AdminManagement'])->name('admin.management');

    Route::get('/admin/location', [AdminController::class, 'AdminLocation'])->name('admin.location');

    Route::get('/admin/about', [AdminController::class, 'AdminAbout'])->name('admin.about');

    Route::get('/admin/pollutants', [PollutantController::class, 'showPollutant'])->name('admin.pollutants');

    Route::get('/admin/location_tab', [LocationController::class, 'index'])->name('admin.location_tab');


}); //End Group Admin middleware

// Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//login and register route is in the auth.php


//group route for user role
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');

    Route::get('/user/location', [UserController::class, 'UserLocation'])->name('user.location');

    Route::get('/user/settings', [UserController::class, 'UserSettings'])->name('user.settings');

});



Route::get('/pdf', [ PdfController::class, 'index' ]);


//Air Quality

//Monitoring
Route::post('/air-quality-data', [AirQualityDataController::class, 'store'])->name('data.store');
Route::get('/pm25-data', [AirQualityDataController::class, 'getPM25Data']);
Route::get('/pm10-data', [AirQualityDataController::class, 'getPM10Data']);
Route::get('/co-data', [AirQualityDataController::class, 'getCOData']);
Route::get('/no2-data', [AirQualityDataController::class, 'getNO2Data']);
Route::get('/o3-data', [AirQualityDataController::class, 'getO3Data']);
//Forecasting
Route::get('/pm25-data-forecast', [AirQualityDataController::class, 'getPM25FCSV']);
Route::get('/pm10-data-forecast', [AirQualityDataController::class, 'getPM10FCSV']);






