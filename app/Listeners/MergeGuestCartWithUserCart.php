<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class MergeGuestCartWithUserCart
{
    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        $guestCart = Session::get('cart', []);
        if (!empty($guestCart)) {
            $userId = $event->user->id;
            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            foreach ($guestCart as $productId) {
                $productId = (int) $productId; // Ensure it's an integer
                Log::info('Product ID:', ['productId' => $productId]);
                $cartItem = $cart->items()->where('product_id', $productId)->first();
                if (!$cartItem) {
                    $cart->items()->create(['product_id' => $productId]);
                }
            }


            Session::forget('cart');
        }
    }
}
