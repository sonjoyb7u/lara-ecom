<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'verify_code', 'address',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

}
