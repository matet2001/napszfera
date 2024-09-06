<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
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
}
