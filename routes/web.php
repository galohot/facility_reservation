<?php

use App\Http\Controllers\AddonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacilityAddonController;
use App\Http\Controllers\FacilityCategoryController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleMasterController;
use App\Http\Controllers\SatkerMasterController;
use App\Http\Controllers\UkerMasterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return redirect('dashboard');});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/facilities/create', [FacilityController::class, 'create'])->name('facilities.create');
    Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
        Route::middleware('verify.manager')->group(function () {
            Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
            Route::get('/facilities/{facility}/reservation-history', [FacilityController::class, 'reservationHistory'])->name('facilities.reservationhistory');
            Route::patch('/facilities/{facility}', [FacilityController::class, 'update'])->name('facilities.update');
            Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('facilities.destroy');

        });
    Route::get('/facility-categories', [FacilityCategoryController::class, 'index'])->name('facility_categories.index');
    Route::get('/facility-categories/create', [FacilityCategoryController::class, 'create'])->name('facility_categories.create');
    Route::post('/facility-categories', [FacilityCategoryController::class, 'store'])->name('facility_categories.store');
    Route::get('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'show'])->name('facility_categories.show');
    Route::get('/facility-categories/{facilityCategory}/edit', [FacilityCategoryController::class, 'edit'])->name('facility_categories.edit');
    Route::patch('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'update'])->name('facility_categories.update');
    Route::delete('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'destroy'])->name('facility_categories.destroy');

    // Addon Routes
    Route::get('/addons', [AddonController::class, 'index'])->name('addons.index');
    Route::get('/addons/create', [AddonController::class, 'create'])->name('addons.create');
    Route::post('/addons', [AddonController::class, 'store'])->name('addons.store');
    Route::get('/addons/{addon}', [AddonController::class, 'show'])->name('addons.show');
    Route::get('/addons/{addon}/edit', [AddonController::class, 'edit'])->name('addons.edit');
    Route::patch('/addons/{addon}', [AddonController::class, 'update'])->name('addons.update');
    Route::delete('/addons/{addon}', [AddonController::class, 'destroy'])->name('addons.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/events',[EventController::class,'index'])->name('events.index');

    Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
    Route::get('/facilities/{facility}', [FacilityController::class, 'show'])->name('facilities.show');

    // Reservation routes
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    // Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    // Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    // Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

});



Route::middleware(['auth', 'verify.reservation', 'role:manager,verificator'])->group(function () {
    // Routes for verification
    Route::get('/reservations/{reservation}/verify', [ReservationController::class, 'preverify'])->name('reservations.preverify');
    Route::patch('/reservations/{reservation}/verify', [ReservationController::class, 'verify'])->name('reservations.verify');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes for verification
    Route::get('/reservations/admin/{reservation}/verify', [ReservationController::class, 'preverify'])->name('reservations.admin.preverify');
    Route::patch('/reservations/admin/{reservation}/verify', [ReservationController::class, 'verify'])->name('reservations.admin.verify');
});

Route::middleware(['auth', 'verify.reservation','verify.status'])->group(function () {
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes accessible only to users with the 'superadmin' role
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // SatkerMaster routes
    Route::get('/satker-masters', [SatkerMasterController::class, 'index'])->name('satker_masters.index');
    Route::get('/satker-masters/create', [SatkerMasterController::class, 'create'])->name('satker_masters.create');
    Route::post('/satker-masters', [SatkerMasterController::class, 'store'])->name('satker_masters.store');
    Route::get('/satker-masters/{satkerMaster}', [SatkerMasterController::class, 'show'])->name('satker_masters.show');
    Route::get('/satker-masters/{satkerMaster}/edit', [SatkerMasterController::class, 'edit'])->name('satker_masters.edit');
    Route::patch('/satker-masters/{satkerMaster}', [SatkerMasterController::class, 'update'])->name('satker_masters.update');
    Route::delete('/satker-masters/{satkerMaster}', [SatkerMasterController::class, 'destroy'])->name('satker_masters.destroy');

        // UkerMaster routes
    Route::get('/uker-masters', [UkerMasterController::class, 'index'])->name('uker_masters.index');
    Route::get('/uker-masters/create', [UkerMasterController::class, 'create'])->name('uker_masters.create');
    Route::post('/uker-masters', [UkerMasterController::class, 'store'])->name('uker_masters.store');
    Route::get('/uker-masters/{ukerMaster}', [UkerMasterController::class, 'show'])->name('uker_masters.show');
    Route::get('/uker-masters/{ukerMaster}/edit', [UkerMasterController::class, 'edit'])->name('uker_masters.edit');
    Route::patch('/uker-masters/{ukerMaster}', [UkerMasterController::class, 'update'])->name('uker_masters.update');
    Route::delete('/uker-masters/{ukerMaster}', [UkerMasterController::class, 'destroy'])->name('uker_masters.destroy');

    // RoleMaster routes
    Route::get('/role-masters', [RoleMasterController::class, 'index'])->name('role_masters.index');
    Route::get('/role-masters/create', [RoleMasterController::class, 'create'])->name('role_masters.create');
    Route::post('/role-masters', [RoleMasterController::class, 'store'])->name('role_masters.store');
    Route::get('/role-masters/{roleMaster}', [RoleMasterController::class, 'show'])->name('role_masters.show');
    Route::get('/role-masters/{roleMaster}/edit', [RoleMasterController::class, 'edit'])->name('role_masters.edit');
    Route::patch('/role-masters/{roleMaster}', [RoleMasterController::class, 'update'])->name('role_masters.update');
    Route::delete('/role-masters/{roleMaster}', [RoleMasterController::class, 'destroy'])->name('role_masters.destroy');
});

// Route::middleware(['auth', 'role:admin,manager'])->group(function () {
//     // Route::get('/facilities/create', [FacilityController::class, 'create'])->name('facilities.create');
//     // Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
//     // Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
//     // Route::patch('/facilities/{facility}', [FacilityController::class, 'update'])->name('facilities.update');
//     // Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('facilities.destroy');

//     // Route::get('/facility-categories', [FacilityCategoryController::class, 'index'])->name('facility_categories.index');
//     // Route::get('/facility-categories/create', [FacilityCategoryController::class, 'create'])->name('facility_categories.create');
//     // Route::post('/facility-categories', [FacilityCategoryController::class, 'store'])->name('facility_categories.store');
//     // Route::get('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'show'])->name('facility_categories.show');
//     // Route::get('/facility-categories/{facilityCategory}/edit', [FacilityCategoryController::class, 'edit'])->name('facility_categories.edit');
//     // Route::patch('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'update'])->name('facility_categories.update');
//     // Route::delete('/facility-categories/{facilityCategory}', [FacilityCategoryController::class, 'destroy'])->name('facility_categories.destroy');

// });



require __DIR__.'/auth.php';