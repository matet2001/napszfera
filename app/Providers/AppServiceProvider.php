<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Setting;  // Import the Setting model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
            $setting = Setting::first();  // Assuming you only have one settings row

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

            // Pass the cart and setting to all views
            $view->with('cart', $cart)->with('setting', $setting);
        });
    }
}
