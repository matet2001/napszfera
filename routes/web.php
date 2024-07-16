<?php

use App\Http\Controllers\ProductsRouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/eloadasok', [ProductsRouteController::class, 'eloadasok']);
Route::get('/meditaciok', [ProductsRouteController::class, 'meditaciok']);
Route::get('/hangoskonyvek', [ProductsRouteController::class, 'hangoskonyvek']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/terms', [StaticPageController::class, 'terms']);
Route::get('/privacy', [StaticPageController::class, 'privacy']);
Route::get('/claim', [StaticPageController::class, 'claim']);

Route::get('/contact', [StaticPageController::class, 'contact']);
Route::get('/about', [StaticPageController::class, 'about']);

require __DIR__.'/auth.php';
