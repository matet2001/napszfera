<?php

namespace App\Models;

use getID3;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file_path', 'product_id', 'isSample'];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAudioDuration()
    {
        $filePath = $this->file_path;

        // Check if the file exists
        if (!file_exists($filePath)) {
            return null; // or handle the error as needed
        }

        // Use getID3 library to retrieve audio file info (make sure to install it)
        $getID3 = new getID3; // Assuming you've included the getID3 library in your project
        $fileInfo = $getID3->analyze($filePath);

        // Check if 'playtime_string' is set and calculate the duration
        if (isset($fileInfo['playtime_string'])) {
            // Split the playtime string by colon
            $timeArray = explode(':', $fileInfo['playtime_string']);

            // Calculate total seconds based on the number of time segments
            $totalSeconds = 0;
            $segmentCount = count($timeArray);

            // Handle durations with hours, minutes, and seconds
            for ($i = 0; $i < $segmentCount; $i++) {
                $totalSeconds += (int)$timeArray[$segmentCount - 1 - $i] * pow(60, $i);
            }

            return $totalSeconds; // Return total duration in seconds
        }

        return 0; // Return null if duration is not found
    }
}
