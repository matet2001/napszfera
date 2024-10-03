<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        'isMultiple'
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function totalDuration()
    {
        // Get audio files related to the product as a collection
        $audioFiles = $this->files()->where('type', 'audio')->get();

        // Use reduce on the collection to sum the total duration
        return $audioFiles->reduce(function ($carry, $file) {
            return $carry + $file->getAudioDuration(); // Accumulate durations
        }, 0);
    }


    public function getAudioFiles() {
        return $this->files()->where('type', 'audio');
    }

    public function getImage()
    {
        $type = $this->getIsImageStand() ? 'imageStand' : 'image';

        return $this->files()->where('type', $type)->first()->file_path;
    }

    // Getter to check if the product has an image stand (for audiobooks)
    public function getIsImageStand()
    {
        // Check if there is an imageStand file related to the product
        return $this->files()->where('type', 'imageStand')->exists();
    }

    // Getter to retrieve the zip file (if exists)
    public function getZipFile()
    {
        return $this->files()->where('type', 'zip')->first();
    }

    // Getter to retrieve the sample audio file (if exists)
    public function getSampleFile()
    {
        return $this->files()->where('type', 'audioSample')->first();
    }

}
