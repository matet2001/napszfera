<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function success(Request $request) {
        dd("success");
    }

    public function cancel(Request $request) {
        dd("cancel");
    }
}
