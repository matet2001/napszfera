<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Define the root directory for products
        $productsRootDir = storage_path('app/public/products/');

        // Define the product categories (types)
        $productTypes = ['meditation', 'lecture', 'audiobook'];

        // Define prices based on type
        $prices = [
            'meditation' => 3000,
            'lecture' => 6000,
            'audiobook' => 6000,
        ];

        // Iterate over each product type (directory)
        foreach ($productTypes as $type) {
            $typeDir = $productsRootDir . $type;

            // Check if the type directory exists
            if (!File::exists($typeDir)) {
                echo "Directory does not exist: $typeDir\n";
                continue;
            }

            // Get all product directories inside the type directory
            $productDirectories = array_diff(scandir($typeDir), ['..', '.']);

            foreach ($productDirectories as $productDir) {
                $productPath = $typeDir . '/' . $productDir;

                // Make sure it's a directory
                if (!is_dir($productPath)) {
                    continue;
                }

                // The product name is the name of the directory
                $productName = $productDir;

                // Find the image (jpg/png) in the product directory
                $imageFile = null;
                foreach (array_diff(scandir($productPath), ['..', '.']) as $file) {
                    if (preg_match('/\.(png|jpg)$/i', $file)) {
                        $imageFile = $file;
                        break;
                    }
                }

                if (!$imageFile) {
                    echo "No image found for product: $productName in $productPath\n";
                    continue;
                }

                // Set the price based on the product type
                $price = $prices[$type];

                // Count the number of MP3 files in the product directory
                $mp3Files = array_filter(array_diff(scandir($productPath), ['..', '.']), function ($file) {
                    return preg_match('/\.mp3$/i', $file);
                });
                $fileCount = count($mp3Files);

                // Set isMultiple to true if more than 1 MP3 file exists, otherwise false
                $isMultiple = $fileCount > 1;

                // Determine if the product is an audiobook to set isImageStand
                $isImageStand = $type === 'audiobook';

                // Output details before creating the product
                echo "Creating product: Name = $productName, Type = $type, Image = $productPath/$imageFile, Price = $price, isMultiple = $isMultiple, isImageStand = $isImageStand\n";

                // Create the product with the price, isSingle status, and isImageStand
                $product = Product::factory()->create([
                    'name' => $productName,
                    'image' => 'storage/products/' . $type . '/' . $productName . '/' . $imageFile, // Use the /storage path
                    'type' => $type,
                    'price' => $price, // Set the price based on the product type
                    'isMultiple' => $isMultiple, // Set isMultiple based on the file count
                    'isImageStand' => $isImageStand, // Set isImageStand based on the product type
                ]);

                // Add MP3 files as related File records
                foreach ($mp3Files as $file) {
                    // Check if the file name contains 'sample'
                    $isSample = stripos($file, 'sample') !== false; // Case-insensitive check for 'sample'

                    // Create the related file entry
                    $product->files()->create([
                        'title' => pathinfo($file, PATHINFO_FILENAME), // Use the filename as the title
                        'file_path' => 'storage/products/' . $type . '/' . $productName . '/' . $file, // File path
                        'isSample' => $isSample, // Set isSample based on whether 'sample' is in the file name
                    ]);

                    echo "Added file: $file to product: $productName, isSample: $isSample\n";
                }


                echo "Product created successfully: $productName\n";
            }

        }
    }
}
