<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFileProgress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'file_id', 'last_position'];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to the File model
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
