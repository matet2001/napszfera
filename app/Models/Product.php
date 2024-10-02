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
        'image',
        'isImageStand',
        'type',
        'isMultiple'
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function totalDuration()
    {
        // Use the `files` relationship and sum the result of `getAudioDuration()` for each file
        return $this->files->reduce(function ($carry, $file) {
            return $carry + $file->getAudioDuration();
        }, 0);
    }

}
