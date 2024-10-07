<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmation;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        if (!session()->has('stripe_session_id')) {
            return redirect()->route('home')->with('warning', 'Nincs befejezett fizetés.');
        }

        // Check if the user is authenticated
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = $this->cartController->getCart();  // Assuming this gets the current cart with items

            // Create or get the user's inventory
            $inventory = Inventory::firstOrCreate(['user_id' => $userId]);

            // Calculate the total price for the order from the cart items
            $totalAmount = 0;
            foreach ($cart->items as $item) {
                $totalAmount += $item->product->price;  // Assuming 'price' and 'quantity' fields
            }

            // Create a new order record
            $order = Order::create([
                'user_id' => $userId,
                'total' => $totalAmount,
                'status' => 'completed',  // You can use any status system you prefer
            ]);

            // Add items to the inventory and attach them to the order
            foreach ($cart->items as $item) {
                // Add the item to the user's inventory
                InventoryItem::create([
                    'inventory_id' => $inventory->id,
                    'product_id' => $item->product_id
                ]);

                // Add the purchased item to the order (assuming you have an OrderItem model)
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,  // Store the price at the time of purchase
                ]);
            }

            // Send purchase confirmation email with the order details
            Mail::to($request->user()->email)->send(new PurchaseConfirmation($order));

            // Empty the user's cart after purchase
            $this->cartController->emptyCart();
        }

        return view('cart.success');  // Display success message or page
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
