<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user owns a specific product.
     *
     * @param int $productId
     * @return bool
     */
    public function ownsProduct($productId)
    {
        return InventoryItem::whereHas('inventory', function ($query) {
            $query->where('user_id', $this->id);
        })->where('product_id', $productId)->exists();
    }

    /**
     * A user has one cart.
     */
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * A user has one inventory.
     */
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function isAdmin()
    {
        return $this->is_admin; // Make sure this column exists in the DB
    }
}
