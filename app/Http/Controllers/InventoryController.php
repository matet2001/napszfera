<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\UserFileProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $inventory = Inventory::with('items.product')->where('user_id', $userId)->first();

            return view('inventory.index', ['inventory' => $inventory]);
        }

        return redirect()->route('login')->with('warning', 'Please log in to view your inventory.');
    }

    public function show(Product $product) {

        if (Auth::check()) {
            $progress = UserFileProgress::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            $currentPage = 1;

            if ($progress) {
                $currentPage = $progress->page_number ? : 1; // Use page number from progress or default to 1
            }

            $filesQuery = $product->files();
            $files = $filesQuery->simplePaginate(1);


            return view('inventory.show', [
                'product' => $product,
                'files' => $files,
                'progress' => $progress
            ]);
        }

        return redirect()->route('login')->with('warning', 'Please log in to view your inventory.');
    }



//    TODO: add product audio model
//    TODO: Add way to upload audio to the admin
}
