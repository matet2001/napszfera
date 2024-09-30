<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stripe\BillingPortal\Session;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function create() {
        dd("create");
        return view('product.create');
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = $this->getCart();
        $cartItems = $cart->items;

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
                // Add tax rates if applicable
            ];
        }

        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'billing_address_collection' => 'required',
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
}
