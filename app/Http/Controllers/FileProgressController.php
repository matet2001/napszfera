<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\UserFileProgress;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileProgressController extends Controller
{
    // In your FileProgressController or appropriate controller
    public function update(Request $request, Product $product, File $file) {
        Log::info($request);
        Log::info($product);
        Log::info($file);

        $request->validate([
            'last_position' => 'required|integer',
//            'page_number' => 'required|integer'
        ]);

        // Update or create user progress
        UserFileProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'file_id' => $file->id
            ],
            [
                'last_position' => $request->last_position,
//                'page_number' => $request->page_number // Store the page number
            ]
        );

        return response()->json(['status' => 'success']);

    }

}

