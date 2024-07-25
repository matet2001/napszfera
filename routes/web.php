<?php

use App\Http\Controllers\ProductsRouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [ProductsRouteController::class, 'index']);
Route::get('/termekek', [ProductsRouteController::class, 'index']);
Route::get('/termekek/eloadasok', [ProductsRouteController::class, 'lecture']);
Route::get('/termekek/meditaciok', [ProductsRouteController::class, 'meditation']);
Route::get('/termekek/hangoskonyvek', [ProductsRouteController::class, 'audiobook']);
Route::get('/termekek/{product}', [ProductsRouteController::class, 'show']);

Route::get('/terms', [StaticPageController::class, 'terms']);
Route::get('/privacy', [StaticPageController::class, 'privacy']);
Route::get('/claim', [StaticPageController::class, 'claim']);

Route::get('/contact', [StaticPageController::class, 'contact']);
Route::get('/about', [StaticPageController::class, 'about']);

Route::get('/search', SearchController::class);

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');;
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
});

require __DIR__.'/auth.php';
