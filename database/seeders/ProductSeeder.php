<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Define the directories
        $imagesDir = storage_path('app/public/product_images/');
        $filesDir = storage_path('app/public/product_files/');

        // Check if directories exist
        if (!File::exists($imagesDir)) {
            echo "Images directory does not exist: $imagesDir\n";
            return;
        }

        if (!File::exists($filesDir)) {
            echo "Files directory does not exist: $filesDir\n";
            return;
        }

        // Get list of mp3 files (product files)
        $audioFiles = array_diff(scandir($filesDir), ['..', '.']);
        echo "Found " . count($audioFiles) . " audio file(s) in $filesDir\n";

        foreach ($audioFiles as $audioFile) {
            // Use the mp3 file name (without extension) as the product name
            $productName = pathinfo($audioFile, PATHINFO_FILENAME);

            echo "Processing audio file: $audioFile, product name: $productName\n";

            // Look for the corresponding image file (which starts with the product name)
            $matchingImage = null;
            foreach (array_diff(scandir($imagesDir), ['..', '.']) as $imageFile) {
                // Check if the image file name starts with the product name
                if (strpos($imageFile, $productName) === 0) {
                    $matchingImage = $imageFile;
                    break;
                }
            }

            if (!$matchingImage) {
                echo "No matching image found for $productName\n";
                continue;
            }

            // Output the product details before creating it
            echo "Creating product: Name = $productName, Image = $imagesDir$matchingImage, Audio = $filesDir$audioFile\n";

            Product::factory()->create([
                'name' => $productName,
                'image' => 'storage/product_images/' . $matchingImage,  // Use the /storage path
                'file_path' => 'storage/product_files/' . $audioFile,
            ]);


            echo "Product created successfully: $productName\n";
        }
    }
}
