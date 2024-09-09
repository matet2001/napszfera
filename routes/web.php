<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InventoryController;
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
Route::get('/termekek', [ProductsRouteController::class, 'index'])->name('products.index');
Route::get('/termekek/eloadasok', [ProductsRouteController::class, 'lecture']);
Route::get('/termekek/meditaciok', [ProductsRouteController::class, 'meditation']);
Route::get('/termekek/hangoskonyvek', [ProductsRouteController::class, 'audiobook']);
Route::get('/termekek/{product}', [ProductsRouteController::class, 'show']);

Route::get('/terms', [StaticPageController::class, 'terms']);
Route::get('/privacy', [StaticPageController::class, 'privacy']);
Route::get('/claim', [StaticPageController::class, 'claim']);

Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/about', [StaticPageController::class, 'about']);

Route::get('/search', [ProductsRouteController::class, 'search']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

require __DIR__ . '/auth.php';
