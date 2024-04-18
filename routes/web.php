<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleCategoryController;
use App\Http\Controllers\VehicleContactBookController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehiclePreviousOwnerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, "index"])->name('dashboard');

// vehicles
Route::prefix('vehicles')->group(function () {
    Route::get('/', [VehicleController::class, "index"])->name('vehicles.index');
    Route::get('/all', [VehicleController::class, "all"])->name('vehicles.all');
    Route::post('/store', [VehicleController::class, "store"])->name('vehicles.store');
    Route::get('/{vehicle_id}/get', [VehicleController::class, "get"])->name('vehicles.get');
    Route::get('/{vehicle_id}/edit', [VehicleController::class, "edit"])->name('vehicles.edit');

    Route::post('/{vehicle_id}/basic/update', [VehicleController::class, "basicUpdate"])->name('vehicles.basic.update');
    Route::delete('/{vehicle_id}/basic/delete', [VehicleController::class, "delete"])->name('vehicles.basic.delete');

    Route::post('/{vehicle_id}/contact/update', [VehicleContactBookController::class, "update"])->name('vehicle.contact.update');
    Route::get('/{vehicle_id}/contact/all', [VehicleContactBookController::class, "all"])->name('vehicle.contact.all');
    Route::delete('/{vehicle_id}/contact/delete', [VehicleContactBookController::class, "delete"])->name('vehicle.contact.delete');

    Route::post('/{vehicle_id}/bank/update', [VehiclePreviousOwnerController::class, "update"])->name('vehicle.bank.update');
    Route::get('/{vehicle_id}/bank/all', [VehiclePreviousOwnerController::class, "all"])->name('vehicle.bank.all');
    Route::delete('/{vehicle_id}/bank/delete', [VehiclePreviousOwnerController::class, "delete"])->name('vehicle.bank.delete');

    Route::post('/select/vehicle/inactive', [VehicleController::class, 'inactiveSelectedItems'])->name('vehicle.inactive.selected');
    Route::post('/select/vehicle/active', [VehicleController::class, 'activeSelectedItems'])->name('vehicle.active.selected');

    Route::post('/select/vehicle/delete', [VehicleController::class, 'deleteSelectedItems'])->name('vehicle.delete.selected');

    // Route::post('/{vehicle_id}/select/vehicle/delete', [VehicleController::class, 'deleteSelectedItems'])->name('vehicle.delete.selected');
});

//Vehicle-Categories
Route::prefix('vehicle-category')->group(function () {
    Route::get('/', [VehicleCategoryController::class, "index"])->name('vehicle-category.index');
    Route::get('/all', [VehicleCategoryController::class, "all"])->name('vehicle-category.all');
    Route::post('/store', [VehicleCategoryController::class, "store"])->name('vehicle-category.store');
    Route::get('/{vehicle_id}/get', [VehicleCategoryController::class, "get"])->name('vehicle-category.get');
    Route::delete('/{vehicle_id}/delete', [VehicleCategoryController::class, "delete"])->name('vehicle-category.delete');
    Route::post('/{vehicle_id}/update', [VehicleCategoryController::class, "update"])->name('vehicle-category.update');
    Route::get('/list', [VehicleCategoryController::class, "list"])->name('vehicle-category.list');
    Route::post('/{vehicle_id}/changeStatus', [VehicleCategoryController::class, "changeStatus"])->name('vehicle-category.changeStatus');
    Route::post('/{vehicle_id}/select/vehicle/delete', [VehicleCategoryController::class, 'deleteSelectedItems'])->name('vehicle-category.delete.selected');
    Route::post('/select/vehicle/inactive', [VehicleCategoryController::class, 'inactiveSelectedItems'])->name('vehicle-category.inactive.selected');
    Route::post('/select/vehicle/active', [VehicleCategoryController::class, 'activeSelectedItems'])->name('vehicle-category.active.selected');
});

// Country Register
Route::prefix('country')->group(function () {
    Route::get('/', [CountryController::class, "index"])->name('country.index');
    Route::get('/all', [CountryController::class, "all"])->name('country.all');
    Route::post('/store', [CountryController::class, "store"])->name('country.store');
    Route::get('/{country_id}/get', [CountryController::class, "get"])->name('country.get');
    Route::delete('/{country_id}/delete', [CountryController::class, "delete"])->name('country.delete');
    Route::post('/{country_id}/update', [CountryController::class, "update"])->name('country.update');
    Route::get('/list', [CountryController::class, "list"])->name('country.list');
    Route::post('/{country_id}/changeStatus', [CountryController::class, "changeStatus"])->name('country.changeStatus');
    Route::post('/{country_id}/select/country/delete', [CountryController::class, 'deleteSelectedItems'])->name('country.delete.selected');
    Route::post('/select/country/inactive', [CountryController::class, 'inactiveSelectedItems'])->name('country.inactive.selected');
    Route::post('/select/country/active', [CountryController::class, 'activeSelectedItems'])->name('country.active.selected');
});

require __DIR__ . '/auth.php';
