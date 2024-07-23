<?php

namespace App\Http\Controllers;

use App\Models\Product;

class SearchController extends Controller
{
    public function __invoke(){
        $productList = Product::query()->
        where('name', 'LIKE', '%'.request('q').'%')->
        get();

        return view('products.product-page', [
            'title' => 'Eredmények',
            'productList' => $productList
        ]);
    }
}
