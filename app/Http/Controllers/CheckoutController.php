<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function success(Request $request) {
        return view('cart.success');
    }

    public function cancel(Request $request) {
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
