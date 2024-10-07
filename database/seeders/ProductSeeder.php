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

                // Set the price based on the product type
                $price = $prices[$type];

                // Scan the product directory and classify files by type
                $files = array_diff(scandir($productPath), ['..', '.']);
                $mp3Files = [];
                $zipFiles = [];
                $imageFiles = [];
                $audioSamples = [];

                foreach ($files as $file) {
                    // Check for image files (jpg, png)
                    if (preg_match('/\.(png|jpg)$/i', $file)) {
                        if ($type === 'audiobook') {
                            $imageFiles[] = ['file' => $file, 'type' => 'imageStand']; // Special rule for audiobooks
                        } else {
                            $imageFiles[] = ['file' => $file, 'type' => 'image'];
                        }
                    }
                    // Check for audio files (mp3)
                    elseif (preg_match('/\.mp3$/i', $file)) {
                        if (stripos($file, 'sample') !== false) {
                            $audioSamples[] = $file;
                        } else {
                            $mp3Files[] = $file;
                        }
                    }
                    // Check for zip files
                    elseif (preg_match('/\.zip$/i', $file)) {
                        $zipFiles[] = $file;
                    }
                }

                // Set isMultiple to true if it has a zip file
                $isMultiple = count($zipFiles) > 0;

                // Check for a description.txt file in the product directory
                $descriptionFilePath = $productPath . '/description.txt';
                $description = null;

                if (file_exists($descriptionFilePath)) {
                    $f = fopen($descriptionFilePath, 'r');
                    $description = fread($f, filesize($descriptionFilePath));
                    fclose($f);

                    if (empty($description)) {
                        echo "Description file is empty for product: $productName in $productPath\n";
                    } else {
                        echo "Read description for product: $productName, length: " . strlen($description) . " characters\n";
                    }
                } else {
                    echo "No description file found for product: $productName in $productPath\n";
                }

                // Create the product
                $product = Product::create([
                    'name' => $productName,
                    'type' => $type,
                    'price' => $price,
                    'isMultiple' => $isMultiple,
                    'description' => $description,
                ]);

                // Add image files as related File records
                foreach ($imageFiles as $image) {
                    $product->files()->create([
                        'title' => pathinfo($image['file'], PATHINFO_FILENAME),
                        'file_path' => $type . '/' . $productName . '/' . $image['file'],
                        'type' => $image['type'],
                    ]);
                    echo "Added image file: {$image['file']} to product: $productName, type: {$image['type']}\n";
                }

                // Add MP3 files as related File records
                foreach ($mp3Files as $file) {
                    $product->files()->create([
                        'title' => pathinfo($file, PATHINFO_FILENAME),
                        'file_path' => $type . '/' . $productName . '/' . $file,
                        'type' => 'audio',
                    ]);
                    echo "Added audio file: $file to product: $productName\n";
                }

                // Add MP3 sample files as related File records
                foreach ($audioSamples as $sample) {
                    $product->files()->create([
                        'title' => pathinfo($sample, PATHINFO_FILENAME),
                        'file_path' => $type . '/' . $productName . '/' . $sample,
                        'type' => 'audioSample',
                    ]);
                    echo "Added audio sample file: $sample to product: $productName\n";
                }

                // Add ZIP files as related File records
                foreach ($zipFiles as $zip) {
                    $product->files()->create([
                        'title' => pathinfo($zip, PATHINFO_FILENAME),
                        'file_path' => $type . '/' . $productName . '/' . $zip,
                        'type' => 'zip',
                    ]);
                    echo "Added ZIP file: $zip to product: $productName\n";
                }

                echo "Product created successfully: $productName\n";
            }
        }
    }
}
