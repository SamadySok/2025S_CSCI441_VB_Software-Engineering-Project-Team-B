<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'total_amount', 'status', 'payment_method'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
