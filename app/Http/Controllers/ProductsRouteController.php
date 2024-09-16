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

        return view('products.index', [
            'title' => 'Termékek',
            'productList' => $productList,
        ]);
    }

    // Display all products of type 'lecture'
    public function lecture() {
        $productList = Product::where('type', 'lecture')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Előadások',
            'productList' => $productList,
        ]);
    }

    // Display all products of type 'meditation'
    public function meditation() {
        $productList = Product::where('type', 'meditation')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Meditációk',
            'productList' => $productList,
        ]);
    }

    // Display all products of type 'audiobook'
    public function audiobook() {
        $productList = Product::where('type', 'audiobook')->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Hangoskönyvek',
            'productList' => $productList,
        ]);
    }

    public function show(Product $product) {

        $relatedProducts = $this->getRelatedProducts($product);

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    protected function getRelatedProducts(Product $product)
    {
        if (Auth::check()) {
            $user = auth()->user(); // Get the authenticated user

            // Get product IDs in the user's cart
            $cartProductIds = $user->cart ? $user->cart->items->pluck('product_id')->toArray() : [];

            // Get product IDs in the user's inventory
            $inventoryProductIds = $user->inventory ? $user->inventory->items->pluck('product_id')->toArray() : [];

            // Combine cart and inventory product IDs into one array for exclusion
            $excludedProductIds = array_merge($cartProductIds, $inventoryProductIds);

            // Query for related products, excluding the current product and those in cart/inventory
            return Product::where('type', $product->type)
                ->where('id', '!=', $product->id) // Exclude the current product
                ->whereNotIn('id', $excludedProductIds) // Exclude products in cart/inventory
                ->take(4)
                ->get();
        } else {
            return Product::where('type', $product->type)
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get();
        }
    }


    public function search() {
        // Get the search query (if any)
        $query = request('q');

        // Query the products and paginate the results
        $productList = Product::query()
            ->where('name', 'LIKE', '%' . $query . '%')
            ->simplePaginate($this->paginationAmount);

        return view('products.index', [
            'title' => 'Eredmények',
            'productList' => $productList,
            'query' => $query,  // Passing the query back for the search input
        ]);
    }
}
