<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'name',
        'email',
        'address',
        'payment_method',
        'order_date',
        'status',
        'total_amount',
    ];

    public $timestamps = true; // Enable timestamps if 'created_at' and 'updated_at' are present in the table

    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
