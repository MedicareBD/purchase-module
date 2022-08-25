<?php

use Modules\Purchase\Http\Controllers\PurchaseController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::post('purchase/search-manufacturer', [PurchaseController::class, 'searchManufacturer'])->name('purchase.search-manufacturer');
    Route::resource('purchase', PurchaseController::class);
});
