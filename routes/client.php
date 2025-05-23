<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CatalogController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SetLocale;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'tm', 'ru'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->middleware([SetLocale::class])->name('lang.switch');

Route::name('client.')->middleware([SetLocale::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
    Route::get('/catalogs/{catalog}', [CatalogController::class, 'show'])->name('catalogs.show');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::resource('/carts', CartController::class);
});

Route::name('profile.')->middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');

});

