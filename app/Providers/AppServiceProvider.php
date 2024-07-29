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
                $cart = Cart::with('items.product')->where('user_id', $userId)->first();

                // Transform authenticated cart to match guest cart structure
                $cart = (object) [
                    'items' => $cart ? $cart->items->map(function ($item) {
                        return (object) [
                            'product_id' => $item->product_id,
                            'name' => $item->product->name,
                            'image' => $item->product->image,
                            'price' => $item->product->price,
                            'description' => $item->product->description,
                            'type' => $item->product->type,
                        ];
                    }) : collect([])
                ];
//                Log::info('Auth Cart data:', ['cart' => $cart]);
            } else {
                $cartItems = session()->get('cart', []);
                $cart = (object) [
                    'items' => collect($cartItems)->map(function ($item) {
                        return (object) [
                            'product_id' => $item['product_id'] ?? null,
                            'name' => $item['name'] ?? 'Unknown', // Default or placeholder name
                            'image' => $item['image'] ?? 'default-image.jpg', // Default or placeholder image
                            'price' => $item['price'] ?? 0, // Default or placeholder price
                            'description' => $item['description'] ?? 'No description available', // Default or placeholder description
                            'type' => $item['type'] ?? 'null',
                        ];
                    })
                ];
//                Log::info('Guest Cart data:', ['cartItems' => $cartItems,'cart' => $cart]);
            }

            $view->with('cart', $cart);
        });
    }
}
