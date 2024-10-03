<?php

namespace App\Models;

use getID3;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'title', 'file_path', 'type'];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAudioDuration()
    {
        $relativeFilePath = 'products/' . $this->file_path; // $this->file_path directly as it's a string

        Log::info("Relative URL of the file: " . $relativeFilePath);

        // Check if the file exists in the 'public' disk
        if (!Storage::disk('public')->exists($relativeFilePath)) {
            return 0;
        }

        // Use getID3 library to retrieve audio file info
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze(Storage::disk('public')->path($relativeFilePath)); // Use path()

        // Check if 'playtime_seconds' is set (it gives duration in seconds)
        if (isset($fileInfo['playtime_seconds'])) {
            return (int) $fileInfo['playtime_seconds']; // Return total duration in seconds
        }

        return 0; // Return 0 if duration is not found
    }

}
