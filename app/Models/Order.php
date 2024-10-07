<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    /**
     * Define relationship with the User model.
     * Each order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relationship with the OrderItem model.
     * Each order has many order items.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
