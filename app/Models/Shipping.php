<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipping extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'shipping_id', 'id');
    }
}
