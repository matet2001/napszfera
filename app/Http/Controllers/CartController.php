<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cart = $this->getCart();

        $cartItem = $cart->items()->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $productId,
            ]);
        }

        return redirect()->back();
    }

    public function remove($itemId)
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $itemId)->delete();

        return redirect()->back();
    }

    protected function getCart()
    {
        $userId = Auth::id();

        $cart = Cart::with('items.product')
            ->where('user_id', $userId)
            ->first();

        if (!$cart) {
            // Create a new cart if none exists
            $cart = Cart::create(['user_id' => $userId]);
        }

        return $cart;
    }
}
