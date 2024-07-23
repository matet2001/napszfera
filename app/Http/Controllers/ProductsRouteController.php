<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsRouteController extends Controller
{
    // Display all products of type 'lecture'
    public function eloadasok() {
        $productList = Product::where('type', 'lecture')->get();

        return view('products.product-page', [
            'title' => 'Előadások',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'meditation'
    public function meditaciok() {
        $productList = Product::where('type', 'meditation')->get();

        return view('products.product-page', [
            'title' => 'Meditációk',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'audiobook'
    public function hangoskonyvek() {
        $productList = Product::where('type', 'audiobook')->get();

        return view('products.product-page', [
            'title' => 'Hangoskönyvek',
            'productList' => $productList
        ]);
    }
}
