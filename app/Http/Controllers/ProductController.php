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
}
