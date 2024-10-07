<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
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

    public function show(Product $product)
    {
        if (Auth::check()) {
            // Get the logged-in user
            $user = Auth::user();

            // Check if the user owns the product by looking in their inventory
            $ownsProduct = InventoryItem::whereHas('inventory', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('product_id', $product->id)->exists();

            // If the user owns the product, show the inventory page
            if ($ownsProduct) {
                return view('inventory.show', [
                    'product' => $product,
                ]);
            } else {
                // If the user does not own the product, redirect to the product page
                return redirect()->route('product.show', $product->id)->with('warning', 'You do not own this product.');
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login')->with('warning', 'Please log in to view your inventory.');
    }

}
