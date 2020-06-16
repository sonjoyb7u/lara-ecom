<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'shipping_id', 'total',
    ];

    public const PENDING_STATUS = 'pending';
    public const SUCCESS_STATUS = 'success';
    public const SHIPPED_STATUS = 'shipped';
    public const RETURN_STATUS = 'return';

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }



}
