<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        $relatedProducts = $this->getRandomProducts();

        return view('cart.index', [
            'cart' => $cart,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function add(Request $request, $productId)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::with('items.product')->where('user_id', $userId)->first();

            if (!$cart) {
                $cart = Cart::create(['user_id' => $userId]);
            }

            $cartItem = $cart->items()->where('product_id', $productId)->first();

            if (!$cartItem) {
                $cart->items()->create(['product_id' => $productId]);
            }
        }

        return redirect()->back();
    }

    public function remove(Request $request, $productId)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();

            if ($cart) {
                $cart->items()->where('product_id', $productId)->delete();
            }
        }

        return redirect()->back();
    }

    public function getCart()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::with('items.product')->where('user_id', $userId)->first();

            if (!$cart) {
                $cart = Cart::create(['user_id' => $userId]);
            }

            return $cart;
        }

        // For guests, you can redirect or handle as needed
        abort(403, 'Unauthorized action.');
    }

    public function checkout()
    {
        if (Auth::check()) {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $cart = $this->getCart();
            $cartItems = $cart->items;
            $user = auth()->user();

            $lineItems = [];
            foreach ($cartItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'huf',
                        'product_data' => [
                            'name' => $item->product->name,
                        ],
                        'unit_amount' => $item->product->price * 100, // in cents
                    ],
                    'quantity' => 1,
                ];
            }

            try {
                $checkoutSession = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'billing_address_collection' => 'required',
                    'customer_email' => $user->email,
                    'success_url' => route('checkout.success'),
                    'cancel_url' => route('checkout.cancel'),
                    'locale' => 'hu',
                ]);

                // Store the session ID in the session
                session(['stripe_session_id' => $checkoutSession->id]);

                return redirect($checkoutSession->url);
            } catch (\Exception $e) {
                return redirect()->route('checkout.cancel')->with('error', 'Payment creation failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('cart.index');
    }


    public function emptyCart()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();

            if ($cart) {
                $cart->items()->delete();
            }
        }

        return redirect()->route('cart.index');
    }

    /**
     * @return mixed
     */
    public function getRandomProducts()
    {
        if (Auth::check()) {
            $user = auth()->user(); // Get the authenticated user

            // Get product IDs in the user's cart
            $cartProductIds = $user->cart ? $user->cart->items->pluck('product_id')->toArray() : [];

            // Get product IDs in the user's inventory
            $inventoryProductIds = $user->inventory ? $user->inventory->items->pluck('product_id')->toArray() : [];

            // Combine cart and inventory product IDs into one array for exclusion
            $excludedProductIds = array_merge($cartProductIds, $inventoryProductIds);

            // Query for related product, excluding the current product and those in cart/inventory
            return Product::whereNotIn('id', $excludedProductIds) // Exclude product in cart/inventory
            ->take(4)
                ->get();
        } else {
            return Product::inRandomOrder()->take(4)->get();
        }
    }
}

