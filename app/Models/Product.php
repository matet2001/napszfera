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
        return $this->files->sum('duration'); // Sum of durations of all files
    }
}
