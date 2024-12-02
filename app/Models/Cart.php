<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'total_price',
        'created_at',
        'updated_at',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
