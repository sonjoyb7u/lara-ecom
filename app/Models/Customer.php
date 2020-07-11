<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'verify_code', 'address', 'image', 'status',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function customer_reviews() {
        return $this->hasMany(CustomerReview::class);
    }

}
