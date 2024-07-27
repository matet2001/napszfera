<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', ['cart' => $cart]);
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            $cart = $this->getCart();
            Log::info('cart: ', [$cart]);
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
                    'description' => $product->description // Ensure the product model has a 'price' attribute
                ];
            }

            Log::info('Cart Items:', ['cart' => $cartItems]);
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

            // Convert cart items to a standard format (collection of objects)
//            $cartItems = $cart->items->map(function ($item) {
//                return (object) [
//                    'id' => $item->id,
//                    'product_id' => $item->product_id,
//                    'product' => (object) [
//                        'id' => $item->product->id,
//                        'name' => $item->product->name,
//                        'image' => $item->product->image,
//                    ],
//                ];
//            });
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


}

