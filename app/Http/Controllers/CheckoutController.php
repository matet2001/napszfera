<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    protected $cartController;

    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }

    public function success(Request $request) {

        // Call the emptyCart method
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = $this->cartController->getCart();

            // Create or get the user's inventory
            $inventory = Inventory::firstOrCreate(['user_id' => $userId]);

            // Add items to the inventory
            //4242 4242 4242 4242
            foreach ($cart->items as $item) {
                InventoryItem::create([
                    'inventory_id' => $inventory->id,
                    'product_id' => $item->product_id
                ]);
            }

            // Optionally empty the cart
            $this->cartController->emptyCart();
        }

        return view('cart.success');
    }

    public function cancel(Request $request) {

        Log::info('Stripe session ID in cancel: ', [session()->get('stripe_session_id')]);

        // Check for an active Stripe session
        if (!session()->has('stripe_session_id')) {
            return redirect()->route('cart.index')->with('warning', 'Nincs megszakított fizetés.');
        }

        // Clear the session after the cancel page is shown
        session()->forget('stripe_session_id');

        // Prevent browser from caching this page
        return response()->view('cart.cancel')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
