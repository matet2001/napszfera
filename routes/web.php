<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BlogController,
    CartController,
    CheckoutController,
    FileProgressController,
    InventoryController,
    ProductController,
    ProductsRouteController,
    ProfileController,
    StaticPageController};

// Product upload routes (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/blog/upload', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/upload', [BlogController::class, 'store'])->name('blog.store');

    Route::get('/product/upload', [ProductsRouteController::class, 'create'])->name('product.create');
    Route::post('/product/upload', [ProductController::class, 'store'])->name('product.store');
});


// Public routes
Route::get('/', [ProductsRouteController::class, 'index'])->name('home');
//Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/product', [ProductsRouteController::class, 'index'])->name('product.index');
Route::get('/product/lecture', [ProductsRouteController::class, 'lecture'])->name('product.lecture');
Route::get('/product/meditation', [ProductsRouteController::class, 'meditation'])->name('product.meditation');
Route::get('/product/audiobook', [ProductsRouteController::class, 'audiobook'])->name('product.audiobook');
Route::get('/product/{product}', [ProductsRouteController::class, 'show'])->name('product.show');

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

    Route::post('/file-progress/{product_id}/{file_id}', [FileProgressController::class, 'update'])->name('file.progress.update');
});




// Authentication routes (if not already included in another file)
require __DIR__ . '/auth.php';
