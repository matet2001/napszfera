<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeederLegacy extends Seeder
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

                // Check for a description.txt file in the product directory
                $descriptionFilePath = $productPath . '/description.txt';
                $description = null;

                if (file_exists($descriptionFilePath)) {

                    $f = fopen($descriptionFilePath, 'r');
                    $description = fread($f, filesize($descriptionFilePath)); // Read the content of the description file

                    // Trim the description to remove any extra whitespace
//                    $description = trim($description);

                    // Debugging: Output the description length and content for verification
                    if (empty($description)) {
                        echo "Description file is empty for product: $productName in $productPath\n";
                    } else {
                        echo "Read description for product: $productName, length: " . strlen($description) . " characters\n";
                    }
                } else {
                    echo "No description file found for product: $productName in $productPath\n";
                }

                // Output details before creating the product
                echo "Creating product: Name = $productName, Type = $type, Image = $productPath/$imageFile, Price = $price, isMultiple = $isMultiple, isImageStand = $isImageStand\n";

                // Create the product with the price, isSingle status, isImageStand, and description
                $product = Product::factory()->create([
                    'name' => $productName,
                    'image' => $type . '/' . $productName . '/' . $imageFile, // Use the /storage path
                    'type' => $type,
                    'price' => $price, // Set the price based on the product type
                    'isMultiple' => $isMultiple, // Set isMultiple based on the file count
                    'isImageStand' => $isImageStand, // Set isImageStand based on the product type
                    'description' => $description, // Set the description if available
                ]);


                // Add MP3 files as related File records
                foreach ($mp3Files as $file) {
                    // Check if the file name contains 'sample'
                    $isSample = stripos($file, 'sample') !== false;

                    // Create the related file entry
                    $product->files()->create([
                        'title' => pathinfo($file, PATHINFO_FILENAME),
                        'file_path' => $type . '/' . $productName . '/' . $file, // File path
                        'isSample' => $isSample,
                    ]);

                    echo "Added file: $file to product: $productName, isSample: $isSample";
                }


                echo "Product created successfully: $productName\n";
            }

        }
    }
}
