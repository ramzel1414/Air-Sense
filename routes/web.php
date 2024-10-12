<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirQualityDataController;
use App\Http\Controllers\DailiyPM25Controller;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PollutantController;
use App\Http\Controllers\LocationController;

use App\Http\Controllers\PdfController;

use App\Http\Controllers\DailyPM25Controller;
use App\Http\Controllers\DailyPM10Controller;
use App\Http\Controllers\DailyCOController;
use App\Http\Controllers\DailyNO2Controller;
use App\Http\Controllers\DailyO3Controller;

use App\Http\Controllers\WeeklyCOController;
use App\Http\Controllers\WeeklyPM25Controller;
use App\Http\Controllers\WeeklyPM10Controller;
use App\Http\Controllers\WeeklyNO2Controller;
use App\Http\Controllers\WeeklyO3Controller;

use App\Http\Controllers\MonthlyPM25Controller;
use App\Http\Controllers\MonthlyPM10Controller;
use App\Http\Controllers\MonthlyCOController;
use App\Http\Controllers\MonthlyNO2Controller;
use App\Http\Controllers\MonthlyO3Controller;
use App\Http\Controllers\PdfControllerCO;
use App\Http\Controllers\PdfControllerNO2;
use App\Http\Controllers\PdfControllerO3;
use App\Http\Controllers\PdfControllerPM10;
use App\Http\Controllers\PdfControllerPM25;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SignatoryController;
use App\Http\Controllers\SitelogoController;

Route::get('/', [PublicController::class, 'index'])->name('index');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/location', [PublicController::class, 'location'])->name('location');

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

    // Route::get('/admin/settings', [AdminController::class, 'AdminSettings'])->name('admin.settings');

    Route::get('/admin/settings', [SignatoryController::class, 'ShowSettings'])->name('admin.settings');

    Route::post('/admin/settings/logo/{id}', [SitelogoController::class, 'UpdateLogo'])->name('admin.update.logo');

    // Route::get('/admin/settings', [SitelogoController::class, 'ShowLogo'])->name('admin.settings');

    Route::put('/admin/settings/{id}', [SignatoryController::class, 'UpdateSignatory'])->name('admin.signatoriesUpdate');

    Route::get('/admin/pollutants', [PollutantController::class, 'showPollutant'])->name('admin.pollutants');

    Route::get('/admin/location_tab', [LocationController::class, 'index'])->name('admin.location_tab');
    Route::put('/admin/devices/{id}/toggle-status', [DeviceController::class, 'toggleStatus'])->name('admin.toggleStatus');

    //Devices
    Route::get('/admin/management', [DeviceController::class, 'AdminManagement'])->name('admin.management');
    Route::put('/admin/management/{id}', [DeviceController::class, 'update'])->name('admin.update');
    Route::delete('/admin/management/{id}', [DeviceController::class, 'delete'])->name('admin.delete');


    Route::post('/devices', [DeviceController::class, 'store'])->name('admin.data.store');
    Route::post('/admin/location/store', [DeviceController::class, 'storeLocation'])->name('admin.location.store');



}); //End Group Admin middleware

// Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//login and register route is in the auth.php


    //REPORT
    Route::get('/pdf', [ PdfController::class, 'index' ])->name('pdf.download');
    Route::get('/pdf/pm25', [ PdfControllerPM25::class, 'index' ])->name('pdf.download.pm25');
    Route::get('/pdf/pm10', [ PdfControllerPM10::class, 'index' ])->name('pdf.download.pm10');
    Route::get('/pdf/co', [ PdfControllerCO::class, 'index' ])->name('pdf.download.co');
    Route::get('/pdf/no2', [ PdfControllerNO2::class, 'index' ])->name('pdf.download.no2');
    Route::get('/pdf/o3', [ PdfControllerO3::class, 'index' ])->name('pdf.download.o3');

    Route::get('/dailypm25', [ DailyPM25Controller::class, 'index' ])->name('daily.pm25');
    Route::get('/dailypm10', [ DailyPM10Controller::class, 'index' ])->name('daily.pm10');
    Route::get('/dailyco', [ DailyCOController::class, 'index' ])->name('daily.co');
    Route::get('/dailyno2', [ DailyNO2Controller::class, 'index' ])->name('daily.no2');
    Route::get('/dailyo3', [ DailyO3Controller::class, 'index' ])->name('daily.o3');

    Route::get('/weeklypm25', [ WeeklyPM25Controller::class, 'index' ])->name('weekly.pm25');
    Route::get('/weeklypm10', [ WeeklyPM10Controller::class, 'index' ])->name('weekly.pm10');
    Route::get('/weeklyco', [ WeeklyCOController::class, 'index' ])->name('weekly.co');
    Route::get('/weeklyno2', [ WeeklyNO2Controller::class, 'index' ])->name('weekly.no2');
    Route::get('/weeklyo3', [ WeeklyO3Controller::class, 'index' ])->name('weekly.o3');

    Route::get('/monthlypm25', [ MonthlyPM25Controller::class, 'index' ])->name('monthly.pm25');
    Route::get('/monthlypm10', [ MonthlyPM10Controller::class, 'index' ])->name('monthly.pm10');
    Route::get('/monthlyco', [ MonthlyCOController::class, 'index' ])->name('monthly.co');
    Route::get('/monthlyno2', [ MonthlyNO2Controller::class, 'index' ])->name('monthly.no2');
    Route::get('/monthlyo3', [ MonthlyO3Controller::class, 'index' ])->name('monthly.o3');
    // Route::get('/site/logo', [ SitelogoController::class, 'logo' ])->name('site.logo');


    //Air Quality//
    //Monitoring
    Route::post('/air-quality-data', [AirQualityDataController::class, 'store'])->name('data.store');
    Route::get('/pm25-data', [AirQualityDataController::class, 'getPM25Data']);
    Route::get('/pm10-data', [AirQualityDataController::class, 'getPM10Data']);
    Route::get('/co-data', [AirQualityDataController::class, 'getCOData']);
    Route::get('/no2-data', [AirQualityDataController::class, 'getNO2Data']);
    Route::get('/o3-data', [AirQualityDataController::class, 'getO3Data']);
    Route::get('/ozone-data', [AirQualityDataController::class, 'getOzoneData']);

    //Forecasting
    Route::get('/pm25-data-forecast', [AirQualityDataController::class, 'getPM25FCSV']);
    Route::get('/pm10-data-forecast', [AirQualityDataController::class, 'getPM10FCSV']);


    //Devices
    Route::get('/device-count', [DeviceController::class, 'getDeviceCount'])->name('device.count');
    Route::get('/device-locations', [DeviceController::class, 'getDeviceLocation'])->name('device.locations');



