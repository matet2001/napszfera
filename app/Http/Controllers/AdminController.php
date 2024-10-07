<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.index',
            ['setting' => $setting]
        );
    }

    public function togglePurchases()
    {
        $setting = Setting::first(); // Assuming you only have one settings row

        // Toggle the purchase status
        $setting->purchase_enabled = !$setting->purchase_enabled;
        $setting->save();

        return back()->with('success', 'Vásárlási beállítások sikeresen frissítve.');
    }
}
