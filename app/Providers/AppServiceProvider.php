<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $cart = null;

            if (Auth::check()) {
                $userId = Auth::id();
                // Load the user's cart with the related products
                $cart = Cart::with('items.product')->where('user_id', $userId)->first();

                if ($cart) {
                    // Transform the authenticated cart to contain actual product instances
                    $cart = (object) [
                        'items' => $cart->items->map(function ($item) {
                            return $item->product;  // Return the Product model directly
                        })
                    ];
                } else {
                    $cart = (object) ['items' => collect([])];  // Empty cart structure
                }
            }

            $view->with('cart', $cart);
        });

    }
}
