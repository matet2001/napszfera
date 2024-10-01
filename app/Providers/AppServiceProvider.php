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
                            'isImageStand' => $item->product->isImageStand,
                        ];
                    }) : collect([])
                ];
//                Log::info('Auth Cart data:', ['cart' => $cart]);
            }
            $view->with('cart', $cart);
        });
    }
}
