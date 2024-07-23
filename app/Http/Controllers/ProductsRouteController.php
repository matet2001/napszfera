<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsRouteController extends Controller
{
    public int $paginationAmount = 12;

    public function index() {
        $productList = Product::simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Termékek',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'lecture'
    public function lecture() {
        $productList = Product::where('type', 'lecture')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Előadások',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'meditation'
    public function meditation() {
        $productList = Product::where('type', 'meditation')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Meditációk',
            'productList' => $productList
        ]);
    }

    // Display all products of type 'audiobook'
    public function audiobook() {
        $productList = Product::where('type', 'audiobook')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Hangoskönyvek',
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
