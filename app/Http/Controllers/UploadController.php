<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function create() {
        return view('product.create');
    }

    public function upload(Request $request)
    {
        // Create a file receiver instance to handle the chunked file upload
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        // Check if the file was uploaded successfully
        if (!$receiver->isUploaded()) {
            Log::error('File upload failed: Receiver did not detect an uploaded file.');
            return response()->json(['error' => 'File upload failed'], 400);
        }

        // Receive the file
        $fileReceived = $receiver->receive();

        // Check if the upload is finished (i.e., all chunks are uploaded)
        if ($fileReceived->isFinished()) {
            // Get the uploaded file instance
            $file = $fileReceived->getFile();

            // Define paths for images and audio files
            $directory = $request->input('type') === 'image' ? 'products/images' : 'products/files';
            $disk = Storage::disk('public');

            // Check if the file already exists
            $filePath = $directory . '/' . $file->getClientOriginalName();
            if ($disk->exists($filePath)) {
                // If the file exists, delete the existing file
                Log::info('File already exists. Deleting old file: ' . $filePath);
                $disk->delete($filePath); // Delete the existing file
            }


            // Store the file temporarily
            $path = $disk->putFileAs($directory, $file, $file->getClientOriginalName());
            Log::info('File stored at path: ' . $path);

            return response()->json([
                'path' => 'storage/' . $path, // Just the relative path
                'filename' => $file->getClientOriginalName()
            ], 200);
        }

        // If the upload is not complete, return the percentage done so far
        $handler = $fileReceived->handler();

        return response()->json([
            'done' => $handler->getPercentageDone(),
            'status' => true
        ], 200);
    }

    // Store product and file information
    public function store(Request $request)
    {
        try {
            // Log the start of the store process
            Log::info('Starting product creation.');

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'imageFilePath' => 'required|string',  // The image file path
                'type' => 'required|string',           // Product type (e.g., meditation, audiobook)
                'audioFilePath' => 'required|string',  // The audio file path
                'isImageStand' => 'nullable|boolean',
            ]);

            // Get the product type and name
            $productType = $request->input('type');

            // Move the image file to the product directory
            $imagePath = $request->input('imageFilePath');

            // Move the audio file to the product directory
            $audioPath = $request->input('audioFilePath');

            // Create the product in the database
            $product = Product::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image' => $imagePath,  // Save the new path of the image
                'isImageStand' => $request->has('isImageStand') ? 1 : 0,
                'type' => $productType,
                'isMultiple' => false,
            ]);

            $this->addProductToAdminInventory($product);

            Log::info('Product created with ID: ' . $product->id);

            // Create a new file entry linked to the product
            File::create([
                'title' => pathinfo($audioPath, PATHINFO_FILENAME),  // Use the filename without the extension as the title
                'file_path' => $audioPath,  // The new audio file path
                'product_id' => $product->id,
                'isSample' => false,
            ]);


            // Log success
            Log::info('Product and associated file created successfully.');

            // Redirect to the newly created product page
            return response()->json([
                'message' => 'Product created successfully!',
                'redirect' => route('product.show', ['product' => $product->id])
            ], 200);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to create product. Error: ' . $e->getMessage());

            // Return a JSON error message with status code 500
            return response()->json(['message' => 'Failed to create product. Error: ' . $e->getMessage()], 500);
        }
    }

    private function addProductToAdminInventory($product) {
        // Get the admin user (assuming there's only one admin)
        $admin = User::where('is_admin', true)->first();

        // Ensure the admin has an inventory
        $inventory = Inventory::firstOrCreate([
            'user_id' => $admin->id,
        ]);

        // Assign the product to the admin's inventory
        InventoryItem::create([
            'inventory_id' => $inventory->id,
            'product_id' => $product->id,
        ]);
    }
}
