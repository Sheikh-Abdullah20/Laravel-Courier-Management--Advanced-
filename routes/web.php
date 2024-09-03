<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DownloadReportController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('guest');
    Route::get('/guest/track/shipment', [GuestController::class, 'tracking'])->name('guest.track-shipment');
    Route::post('/guest/contact-us', [GuestController::class, 'contact'])->name('guest.contact-us');
});
// Guest Routes

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {

    // Resource Controllers Start
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/agent', AgentController::class);
    Route::resource('/status', StatusController::class);
    Route::resource('/shipment', ShipmentController::class);
    Route::resource('/tracking', TrackingController::class);
    Route::resource('/rider', RiderController::class);
    // Resource Controllers End

    // Assigned Shipment Rider Route Start
    Route::get('/assigned_shipments/rider/{id}',[RiderController::class, 'assignedShipment_riders'])->name('assignedShipment_riders');
    // Assigned Shipment Rider Route End

    // Reports Route
    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    // Reports Route

    // Download Reports Controller Start
    Route::get('/download/shipment_report', [DownloadReportController::class, 'shipmentReport'])->name('download_shipment');

    Route::get('/download/user_report', [DownloadReportController::class, 'userReport'])->name('download_user_report');

    Route::get('/download/agent_report', [DownloadReportController::class, 'agentReport'])->name('download_agent_report');

    Route::get('/download/rider_report', [DownloadReportController::class, 'riderReport'])->name('download_rider_report');
    // Download Reports Controller End

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete-confirmation', [ProfileController::class, 'accountDelete'])->name('accountDeactivation');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
