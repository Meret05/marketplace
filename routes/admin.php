<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdminMiddleware::class, SetLocale::class])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('attribute-values', AttributeValueController::class);
    Route::get('/products/{product}/variations/create', [VariationController::class, 'create'])->name('variations.create');
    Route::post('/product-variations', [VariationController::class, 'store'])->name('variations.store');
    Route::delete('variations/{variation}', [VariationController::class, 'destroy'])->name('variations.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('catalogs', CatalogController::class);
    Route::delete('{image}', [ImageController::class, 'destroy'])->name('image.destroy');
});


