<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsRouteController extends Controller
{
    public int $paginationAmount = 12;

    public function index() {
        $productList = Product::simplePaginate($this->paginationAmount);
//        $cart = $this->getCart();

        return view('products.index', [
            'title' => 'Termékek',
            'productList' => $productList,
//            'cart' => $cart
        ]);
    }

    // Display all products of type 'lecture'
    public function lecture() {
        $productList = Product::where('type', 'lecture')->simplePaginate($this->paginationAmount);
        $cart = $this->getCart();

        return view('products.index', [
            'title' => 'Előadások',
            'productList' => $productList,
            'cart' => $cart
        ]);
    }

    // Display all products of type 'meditation'
    public function meditation() {
        $productList = Product::where('type', 'meditation')->simplePaginate($this->paginationAmount);
        $cart = $this->getCart();

        return view('products.index', [
            'title' => 'Meditációk',
            'productList' => $productList,
            'cart' => $cart
        ]);
    }

    // Display all products of type 'audiobook'
    public function audiobook() {
        $productList = Product::where('type', 'audiobook')->simplePaginate($this->paginationAmount);
        $cart = $this->getCart();

        return view('products.index', [
            'title' => 'Hangoskönyvek',
            'productList' => $productList,
            'cart' => $cart
        ]);
    }

    public function show(Product $product) {
        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        $cart = $this->getCart();

        return view('products.show', [
           'product' => $product,
            'relatedProducts' => $relatedProducts,
            'cart' => $cart
        ]);
    }

    protected function getCart()
    {
        $userId = Auth::id();
        return Cart::with('items.product')->where('user_id', $userId)->firstOrFail();
    }
}
