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
Route::get('/products', [ProductsRouteController::class, 'index'])->name('products.index');
Route::get('/products/lecture', [ProductsRouteController::class, 'lecture'])->name('products.lecture');
Route::get('/products/meditation', [ProductsRouteController::class, 'meditation'])->name('products.meditation');
Route::get('/products/audiobook', [ProductsRouteController::class, 'audiobook'])->name('products.audiobook');
Route::get('/products/{product}', [ProductsRouteController::class, 'show'])->name('products.show');

// Search route
Route::get('/search', [ProductsRouteController::class, 'search'])->name('search');

// Static pages
Route::get('/terms', [StaticPageController::class, 'terms'])->name('terms');
Route::get('/privacy', [StaticPageController::class, 'privacy'])->name('privacy');
Route::get('/claim', [StaticPageController::class, 'claim'])->name('claim');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/about', [StaticPageController::class, 'about'])->name('about');

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
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/{product}', [InventoryController::class, 'show'])->name('inventory.show');
});

// Product upload routes (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/upload', [ProductController::class, 'create'])->name('products.create');
    Route::post('/upload', [ProductController::class, 'store'])->name('products.store');
});


// Authentication routes (if not already included in another file)
require __DIR__ . '/auth.php';
