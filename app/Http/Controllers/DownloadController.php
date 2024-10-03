<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download($id)
    {
        $product = Product::findOrFail($id);

        // Check if the product has multiple files
        if ($product->isMultiple) {
            $zippFile = $product->getZipFile(); // Retrieve the first file

            if ($zippFile) {
                // Construct the relative file path
                $relativeFilePath = 'products/' . $zippFile->file_path;

                Log::info("Relative URL of the file: " . $relativeFilePath);

                // Check if the file exists in the 'public' disk
                if (Storage::disk('public')->exists($relativeFilePath)) {
                    Log::info("File gets downloaded");

                    // Get the full path to the file
                    $fullPath = Storage::disk('public')->path($relativeFilePath);

                    // Use response()->streamDownload to manually stream the file in chunks
                    return response()->streamDownload(function () use ($fullPath) {
                        $stream = fopen($fullPath, 'r');
                        while (!feof($stream)) {
                            echo fread($stream, 1024 * 8); // Output 8KB chunks
                            ob_flush(); // Flush output buffer
                            flush();    // Ensure the buffer is flushed immediately
                        }
                        fclose($stream);
                    }, basename($fullPath));
                }

                // If the file does not exist, return a 404 response
                return abort(404, 'File not found');
            }

            Log::info("File not found at");
            return redirect()->back()->with('error', 'Product folder not found.');
        } else {
            // Download the first file if the product has only one file
            $firstFile = $product->getAudioFiles()->first(); // Retrieve the first file

            if ($firstFile) {
                // Ensure the file path is correctly referenced from 'public/storage'
                $relativeFilePath = 'products/' . $firstFile->file_path;

                Log::info("Relative URL of the file: " . $relativeFilePath);

                // Check if the file exists in the 'public' disk
                if (Storage::disk('public')->exists($relativeFilePath)) {
                    Log::info("File gets downloaded");

                    // Download the file using the relative path
                    return Storage::disk('public')->download($relativeFilePath);
                }

                Log::info("File not found at " . $relativeFilePath);
                return redirect()->back()->with('error', 'File not found.');
            }



            return redirect()->back()->with('error', 'No files available for this product.');
        }
    }

}
