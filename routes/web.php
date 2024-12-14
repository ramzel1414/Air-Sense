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

use App\Http\Controllers\PublicController;

//FPDF Report
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PdfControllerCO;
use App\Http\Controllers\Reports\CO\PdfControllerCOFilter;
use App\Http\Controllers\Reports\CO\PdfControllerCOFilterYearly;
use App\Http\Controllers\PdfControllerNO2;
use App\Http\Controllers\Reports\NO2\PdfControllerNO2Filter;
use App\Http\Controllers\Reports\NO2\PdfControllerNO2FilterYearly;
use App\Http\Controllers\PdfControllerO3;
use App\Http\Controllers\Reports\O3\PdfControllerO3Filter;
use App\Http\Controllers\Reports\O3\PdfControllerO3FilterYearly;
use App\Http\Controllers\PdfControllerPM10;
use App\Http\Controllers\Reports\PM10\PdfControllerPM10Filter;
use App\Http\Controllers\Reports\PM10\PdfControllerPM10FilterYearly;
use App\Http\Controllers\PdfControllerPM25;
use App\Http\Controllers\Reports\PM25\PdfControllerPM25Filter;
use App\Http\Controllers\Reports\PM25\PdfControllerPM25FilterYearly;

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



});

    //REPORT
    Route::get('/pdf', [ PdfController::class, 'index' ])->name('pdf.download');

    Route::get('/pdf/pm25', [ PdfControllerPM25::class, 'index' ])->name('pdf.download.pm25');
    Route::get('/pdf/pm25/{year}/{month}', [PdfControllerPM25Filter::class, 'index']);
    Route::get('/pdf/pm25/{year}', [PdfControllerPM25FilterYearly::class, 'index']);

    Route::get('/pdf/pm10', [ PdfControllerPM10::class, 'index' ])->name('pdf.download.pm10');
    Route::get('/pdf/pm10/{year}/{month}', [PdfControllerPM10Filter::class, 'index']);
    Route::get('/pdf/pm10/{year}', [PdfControllerPM10FilterYearly::class, 'index']);

    Route::get('/pdf/co', [ PdfControllerCO::class, 'index' ])->name('pdf.download.co');
    Route::get('/pdf/co/{year}/{month}', [PdfControllerCOFilter::class, 'index']);
    Route::get('/pdf/co/{year}', [PdfControllerCOFilterYearly::class, 'index']);


    Route::get('/pdf/no2', [ PdfControllerNO2::class, 'index' ])->name('pdf.download.no2');
    Route::get('/pdf/no2/{year}/{month}', [PdfControllerNO2Filter::class, 'index']);
    Route::get('/pdf/no2/{year}', [PdfControllerNO2FilterYearly::class, 'index']);


    Route::get('/pdf/o3', [ PdfControllerO3::class, 'index' ])->name('pdf.download.o3');
    Route::get('/pdf/o3/{year}/{month}', [PdfControllerO3Filter::class, 'index']) ;
    Route::get('/pdf/o3/{year}', [PdfControllerO3FilterYearly::class, 'index']) ;

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



