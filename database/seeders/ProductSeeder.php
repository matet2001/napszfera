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

                // Output details before creating the product
                echo "Creating product: Name = $productName, Type = $type, Image = $productPath/$imageFile, Price = $price\n";

                // Create the product with the price
                $product = Product::factory()->create([
                    'name' => $productName,
                    'image' => 'storage/products/' . $type . '/' . $productName . '/' . $imageFile, // Use the /storage path
                    'type' => $type,
                    'price' => $price, // Set the price based on the product type
                ]);

                // Find all the mp3 files and create related File records
                foreach (array_diff(scandir($productPath), ['..', '.']) as $file) {
                    if (preg_match('/\.mp3$/i', $file)) {
                        // Create the related file entry
                        $product->files()->create([
                            'title' => pathinfo($file, PATHINFO_FILENAME), // Use the filename as the title
                            'file_path' => 'storage/products/' . $type . '/' . $productName . '/' . $file, // File path
                        ]);

                        echo "Added file: $file to product: $productName\n";
                    }
                }

                echo "Product created successfully: $productName\n";
            }
        }
    }
}
