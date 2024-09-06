<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        // Get 4 random products
        $randomProducts = Product::inRandomOrder()->take(4)->get();

        return view('cart.index', [
            'cart' => $cart,
            'randomProducts' => $randomProducts,
        ]);
    }


    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            $cart = $this->getCart();
            //Log::info('cart: ', [$cart]);
            $cartItem = $cart->items->where('product_id', $productId)->first();
            if ($cartItem) {
                // Item already in cart
                $cartItem->save();
            } else {
                $cart->items()->create(['product_id' => $productId]);

            }
        } else {
            // For guest users
            $cartItems = session()->get('cart', []);
            $exists = false;

            foreach ($cartItems as $item) {
                if ($item['product_id'] === $productId) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $cartItems[] = [
                    'product_id' => $productId,
                    'image' => $product->image, // Ensure the product model has an 'image' attribute
                    'name' => $product->name, // Ensure the product model has a 'name' attribute
                    'price' => $product->price, // Ensure the product model has a 'price' attribute
                    'description' => $product->description, // Ensure the product model has a 'price' attribute
                    'type' => $product->type,
                ];
            }

            //Log::info('Cart Items:', ['cart' => $cartItems]);
            session()->put('cart', $cartItems);
        }

        return redirect()->back();
    }

    public function remove(Request $request, $productId)
    {
        if (Auth::check()) {
            // For authenticated users
            $cart = $this->getCart();
            $cart->items()->where('product_id', $productId)->delete();
        } else {
            // For guest users
            $cartItems = session()->get('cart', []);
            $cartItems = array_filter($cartItems, function ($item) use ($productId) {
                return $item['product_id'] !== $productId; // Compare with product_id for guest users
            });

            session()->put('cart', array_values($cartItems)); // Re-index array
        }

        return redirect()->back();
    }

    protected function getCart(){
        if (Auth::check()) {
            $userId = Auth::id();

            // Try to find an existing cart for the authenticated user
            $cart = Cart::with('items.product')->where('user_id', $userId)->first();

            // If no cart exists, create a new one
            if (!$cart) {
                $cart = Cart::create(['user_id' => $userId]);
            }

            return $cart;
        } else {
            // For guests, use a cart stored in the session
            $cart = session()->get('cart', []);

            // Convert the session data into a collection of CartItem-like objects
            $cartItems = collect($cart)->map(function ($item) {
                return (object) $item;
            });

        }
        return (object) ['items' => $cartItems];
    }

    public function checkout(){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cartItems = $this->getCart()->items; // or $cart->items

        // Stripe requires items to be formatted as line items
        $lineItems = [];


        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price * 100, // in cents
                ],
                'quantity' => 1,
//                'tax_rates' => ['txr_1PvbV1KX1wr8f3rvV1y7EM6O'],
            ];
        }

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [$lineItems],
                'mode' => 'payment',
                'billing_address_collection' => 'required',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
                'locale' => 'hu',
            ]);

            session(['stripe_session_id' => $checkoutSession->id]);

            // Return session ID to frontend
            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            return redirect('checkout.cancel');
        }
    }
}

