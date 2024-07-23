<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsRouteController extends Controller
{
    // Display all products of type 'lecture'
    public function lecture() {
        $productList = Product::where('type', 'lecture')->get();

        return view('products.index', [
            'title' => 'Előadások',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'meditation'
    public function meditation() {
        $productList = Product::where('type', 'meditation')->get();

        return view('products.index', [
            'title' => 'Meditációk',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'audiobook'
    public function audiobook() {
        $productList = Product::where('type', 'audiobook')->get();

        return view('products.index', [
            'title' => 'Hangoskönyvek',
            'productList' => $productList
        ]);
    }

    public function index() {
        $productList = Product::all();

        return view('products.index', [
            'title' => 'Termékek',
            'productList' => $productList
        ]);
    }

    public function show(Product $product) {
        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', [
           'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }
}
