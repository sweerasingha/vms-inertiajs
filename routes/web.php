<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitOfMeasureController;
use App\Http\Controllers\VendorBankAccountController;
use App\Http\Controllers\VendorContactBookController;
use App\Http\Controllers\VendorFinanceRecordController;
use App\Http\Controllers\VendorPartnerAccountController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\VendorTaxController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, "index"])->name('dashboard');

Route::middleware([App\Http\Middleware\CorsMiddleware::class])->get('/test', function () {
    return 'CORS should be handled here';
});


Route::prefix('material-category')->group(function () {
    Route::get('/', [MaterialCategoryController::class, "index"])->name('materialCategory.index');
    Route::post('/store', [MaterialCategoryController::class, "store"])->name('materialCategory.store');
    Route::get('/all', [MaterialCategoryController::class, "all"])->name('materialCategory.all');
    Route::get('/all/list', [MaterialCategoryController::class, "allList"])->name('materialCategory.all.list');
    Route::get('/level1/all', [MaterialCategoryController::class, "allLevel1"])->name('materialCategory.level1.all');
    Route::get('/{parent_category_id}/level2/all', [MaterialCategoryController::class, "allLevel2"])->name('materialCategory.level2.all');
    Route::get('/{parent_category_id}/level3/all', [MaterialCategoryController::class, "allLevel3"])->name('materialCategory.level3.all');
    Route::get('/{parent_category_id}/level4/all', [MaterialCategoryController::class, "allLevel4"])->name('materialCategory.level4.all');
    Route::delete('/{category_id}/delete', [MaterialCategoryController::class, "delete"])->name('materialCategory.sub.delete');
    Route::get('/{category_id}/get', [MaterialCategoryController::class, "get"])->name('materialCategory.get');
    Route::post('/{category_id}/update', [MaterialCategoryController::class, "update"])->name('materialCategory.update');
});


// Vendors
Route::prefix('vendors')->group(function () {
    Route::get('/', [VendorsController::class, "index"])->name('vendors.index');
    Route::get('/all', [VendorsController::class, "all"])->name('vendors.all');
    Route::post('/store', [VendorsController::class, "store"])->name('vendors.store');
    Route::get('/{vendor_id}/get', [VendorsController::class, "get"])->name('vendors.get');
    Route::get('/{vendor_id}/edit', [VendorsController::class, "edit"])->name('vendors.edit');

    Route::post('/{vendor_id}/basic/update', [VendorsController::class, "basicUpdate"])->name('vendors.basic.update');
    Route::delete('/{vendor_id}/basic/delete', [VendorsController::class, "delete"])->name('vendors.basic.delete');

    Route::post('/{vendor_id}/contact/update', [VendorContactBookController::class, "update"])->name('vendor.contact.update');
    Route::get('/{vendor_id}/contact/all', [VendorContactBookController::class, "all"])->name('vendor.contact.all');
    Route::delete('/{vendor_id}/contact/delete', [VendorContactBookController::class, "delete"])->name('vendor.contact.delete');

    Route::post('/{vendor_id}/bank/update', [VendorBankAccountController::class, "update"])->name('vendor.bank.update');
    Route::get('/{vendor_id}/bank/all', [VendorBankAccountController::class, "all"])->name('vendor.bank.all');
    Route::delete('/{vendor_id}/bank/delete', [VendorBankAccountController::class, "delete"])->name('vendor.bank.delete');

    Route::post('/{vendor_id}/finance/update', [VendorFinanceRecordController::class, "update"])->name('vendor.finance.update');
    Route::get('/{vendor_id}/finance/get', [VendorFinanceRecordController::class, "get"])->name('vendor.finance.get');

    Route::post('/{vendor_id}/partner/update', [VendorPartnerAccountController::class, "update"])->name('vendor.partner.update');
    Route::get('/{vendor_id}/partner/all', [VendorPartnerAccountController::class, "all"])->name('vendor.partner.all');
    Route::delete('/{vendor_id}/partner/delete', [VendorPartnerAccountController::class, "delete"])->name('vendor.partner.delete');

    Route::post('/{vendor_id}/tax/update', [VendorTaxController::class, "update"])->name('vendor.tax.update');
    Route::get('/{vendor_id}/tax/all', [VendorTaxController::class, "all"])->name('vendor.tax.all');
    Route::delete('/{vendor_id}/tax/delete', [VendorTaxController::class, "delete"])->name('vendor.tax.delete');

    Route::post('/select/vendor/inactive', [VendorsController::class, 'inactiveSelectedItems'])->name('vendor.inactive.selected');
    Route::post('/select/vendor/active', [VendorsController::class, 'activeSelectedItems'])->name('vendor.active.selected');

    Route::post('/{vendor_id}/select/vendor/delete', [VendorsController::class, 'deleteSelectedItems'])->name('vendor.delete.selected');
});

Route::prefix('units')->group(function () {
    Route::get('/', [UnitOfMeasureController::class, "index"])->name('units.index');
    Route::get('/all', [UnitOfMeasureController::class, "all"])->name('units.all');
    Route::post('/store', [UnitOfMeasureController::class, "store"])->name('units.store');
    Route::get('/{unit_id}/get', [UnitOfMeasureController::class, "get"])->name('units.get');
    Route::delete('/{unit_id}/delete', [UnitOfMeasureController::class, "delete"])->name('units.delete');
    Route::post('/{unit_id}/update', [UnitOfMeasureController::class, "update"])->name('units.update');
    Route::get('/list', [UnitOfMeasureController::class, "list"])->name('units.list');
    Route::post('/{unit_id}/changeStatus', [UnitOfMeasureController::class, "changeStatus"])->name('units.changeStatus');

    Route::post('/{unit_id}/select/unit/delete', [UnitOfMeasureController::class, 'deleteSelectedItems'])->name('units.delete.selected');
    Route::post('/select/unit/inactive', [UnitOfMeasureController::class, 'inactiveSelectedItems'])->name('units.inactive.selected');
    Route::post('/select/unit/active', [UnitOfMeasureController::class, 'activeSelectedItems'])->name('units.active.selected');
});

// Country Registry
Route::prefix('country')->group(function () {
    Route::get('/', [CountryController::class, "index"])->name('country.index');
    Route::get('/all', [CountryController::class, "all"])->name('country.all');
    Route::post('/store', [CountryController::class, "store"])->name('country.store');
    Route::get('/{country_id}/get', [CountryController::class, "get"])->name('country.get');
    Route::post('/{country_id}/update', [CountryController::class, "update"])->name('country.update');
    Route::delete('/{country_id}/delete', [CountryController::class, "delete"])->name('country.delete');

    Route::post('/{country_id}/select/country/delete', [CountryController::class, 'deleteSelectedItems'])->name('country.delete.selected');
    Route::post('/select/country/inactive', [CountryController::class, 'inactiveSelectedItems'])->name('country.inactive.selected');
    Route::post('/select/country/active', [CountryController::class, 'activeSelectedItems'])->name('country.active.selected');

});

// Currency Registry
Route::prefix('currency')->group(function () {
    Route::get('/', [CurrencyController::class, "index"])->name('currency.index');
    Route::get('/all', [CurrencyController::class, "all"])->name('currency.all');
    Route::get('/active/all', [CurrencyController::class, "activeAll"])->name('currency.active.all');
    Route::post('/store', [CurrencyController::class, "store"])->name('currency.store');
    Route::post('/base/store', [CurrencyController::class, "baseCurrencyStore"])->name('currency.base.update');
    Route::get('/base/get', [CurrencyController::class, "getBaseCurrency"])->name('currency.base.get');
    Route::get('/{currency_id}/get', [CurrencyController::class, "get"])->name('currency.get');
    Route::post('/{currency_id}/update', [CurrencyController::class, "update"])->name('currency.update');
    Route::delete('/{currency_id}/delete', [CurrencyController::class, "delete"])->name('currency.delete');

    Route::post('/{currency_id}/select/currency/delete', [CurrencyController::class, 'deleteSelectedItems'])->name('currency.delete.selected');
    Route::post('/select/currency/inactive', [CurrencyController::class, 'inactiveSelectedItems'])->name('currency.inactive.selected');
    Route::post('/select/currency/active', [CurrencyController::class, 'activeSelectedItems'])->name('currency.active.selected');

});

require __DIR__ . '/auth.php';
