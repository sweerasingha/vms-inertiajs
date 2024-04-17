<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleCategoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, "index"])->name('dashboard');

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
