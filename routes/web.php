<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CartController,
    CheckoutController,
    InventoryController,
    ProductController,
    ProductsRouteController,
    ProfileController,
    StaticPageController
};

// Public routes
Route::get('/', [ProductsRouteController::class, 'index'])->name('home');
Route::get('/termekek', [ProductsRouteController::class, 'index'])->name('products.index');
Route::get('/termekek/eloadasok', [ProductsRouteController::class, 'lecture']);
Route::get('/termekek/meditaciok', [ProductsRouteController::class, 'meditation']);
Route::get('/termekek/hangoskonyvek', [ProductsRouteController::class, 'audiobook']);
Route::get('/termekek/{product}', [ProductsRouteController::class, 'show']);

Route::get('/search', [ProductsRouteController::class, 'search']);

// Static pages
Route::get('/terms', [StaticPageController::class, 'terms']);
Route::get('/privacy', [StaticPageController::class, 'privacy']);
Route::get('/claim', [StaticPageController::class, 'claim']);
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/about', [StaticPageController::class, 'about']);

// for logged-in users only
Route::middleware('auth')->group(function () {
    // Authentication routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Checkout routes
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    // Inventory routes
    Route::get('/termekeim', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/termekeim/{product}', [InventoryController::class, 'show'])->name('inventory.show');
});

// Product upload routes (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/feltoltes', [ProductController::class, 'create'])->name('products.create');
    Route::post('/feltoltes', [ProductController::class, 'store'])->name('products.store');
});


// Authentication routes (if not already included in another file)
require __DIR__ . '/auth.php';
