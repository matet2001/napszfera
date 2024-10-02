<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public int $paginationAmount = 12;

    public function index()
    {
        // Fetch latest post
        $latestPost = Post::latest()->first();
//        dd($latestPost);

        // Fetch products with pagination
        $productList = Product::simplePaginate($this->paginationAmount);

        return view('product.index', [
            'title' => 'Alkotásaim',
            'productList' => $productList,
            'latestPost' => $latestPost, // Pass the latest post to the view
        ]);
    }


    // Display all product of type 'lecture'
    public function lecture() {
        $productList = Product::where('type', 'lecture')->simplePaginate($this->paginationAmount);

        return view('product.index', [
            'title' => 'Előadások',
            'productList' => $productList,
        ]);
    }

    // Display all product of type 'meditation'
    public function meditation() {
        $productList = Product::where('type', 'meditation')->simplePaginate($this->paginationAmount);

        return view('product.index', [
            'title' => 'Meditációk',
            'productList' => $productList,
        ]);
    }

    // Display all product of type 'audiobook'
    public function audiobook() {
        $productList = Product::where('type', 'audiobook')->simplePaginate($this->paginationAmount);

        return view('product.index', [
            'title' => 'Hangoskönyvek',
            'productList' => $productList,
        ]);
    }

    public function show(Product $product) {

        $relatedProducts = $this->getRelatedProducts($product);

        return view('product.show', [
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

            // Query for related product, excluding the current product and those in cart/inventory
            return Product::where('type', $product->type)
                ->where('id', '!=', $product->id) // Exclude the current product
                ->whereNotIn('id', $excludedProductIds) // Exclude product in cart/inventory
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

        // Query the product and paginate the results
        $productList = Product::query()
            ->where('name', 'LIKE', '%' . $query . '%')
            ->simplePaginate($this->paginationAmount);

        return view('product.index', [
            'title' => 'Eredmények',
            'productList' => $productList,
            'query' => $query,  // Passing the query back for the search input
        ]);
    }
}
