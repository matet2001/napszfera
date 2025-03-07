<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,
    BlogController,
    BugReportController,
    CartController,
    CheckoutController,
    DownloadController,
    InventoryController,
    ProductController,
    ProfileController,
    StaticPageController,
    UploadController};

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/test-email-verification', function (Request $request) {
    $user = Auth::user(); // Assuming you're logged in as a user

    // Send the verification email
    if ($user) {
        $user->sendEmailVerificationNotification();
        return 'Verification email sent to ' . $user->email;
    }

    return 'No user is logged in.';
});


// Product upload routes (admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/blog/upload', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/upload', [BlogController::class, 'store'])->name('blog.store');

    Route::get('/product/upload', [UploadController::class, 'create'])->name('product.create');
    Route::post('/product/store', [UploadController::class, 'store'])->name('product.store');
    Route::post('/product/upload', [UploadController::class, 'upload'])->name('product.upload');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'togglePurchases'])->name('admin.toggle-purchases');
});


// Public routes
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/lecture', [ProductController::class, 'lecture'])->name('product.lecture');
Route::get('/product/meditation', [ProductController::class, 'meditation'])->name('product.meditation');
Route::get('/product/audiobook', [ProductController::class, 'audiobook'])->name('product.audiobook');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');


// Search route
Route::get('/search', [ProductController::class, 'search'])->name('search');

// Static pages
Route::get('/terms', [StaticPageController::class, 'terms'])->name('terms');
Route::get('/privacy', [StaticPageController::class, 'privacy'])->name('privacy');
Route::get('/claim', [StaticPageController::class, 'claim'])->name('claim');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/about', [StaticPageController::class, 'about'])->name('about');

// for logged-in users only
Route::middleware(['auth', 'verified'])->group(function () {
    // Authentication routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::middleware('purchases.enabled')->group(function () {
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    // Checkout routes
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/inventory/{product}', [InventoryController::class, 'show'])->name('inventory.show');

    // Route for downloading the entire folder
    Route::get('/product/download/{id}', [DownloadController::class, 'download'])->name('product.download');

    Route::post('/bug/report', [BugReportController::class, 'store'])->name('bug.report');
});

// Authentication routes (if not already included in another file)
require __DIR__ . '/auth.php';
