<?php

use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\AttributeValueController;
use App\Http\Controllers\Seller\ImageController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\VariationController;
use App\Http\Middleware\IsSellerMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


Route::get('seller/create', [StoreController::class, 'create'])->name('seller.store.create')->middleware(['auth', SetLocale::class]);
Route::post('seller/create', [StoreController::class, 'store'])->name('seller.store.store')->middleware(['auth', SetLocale::class]);

Route::prefix('seller')->name('seller.')->middleware(['auth', IsSellerMiddleware::class, SetLocale::class])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attribute-values', AttributeValueController::class);
    Route::get('/products/{product}/variations/create', [VariationController::class, 'create'])->name('variations.create');
    Route::post('/product-variations', [VariationController::class, 'store'])->name('variations.store');
    Route::delete('variations/{variation}', [VariationController::class, 'destroy'])->name('variations.destroy');
    Route::delete('{image}', [ImageController::class, 'destroy'])->name('image.destroy');
});


