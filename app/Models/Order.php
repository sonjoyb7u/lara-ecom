<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id', 'shipping_id', 'total',
    ];

    public const PENDING_STATUS = 'pending';
    public const SUCCESS_STATUS = 'success';
    public const SHIPPED_STATUS = 'shipped';
    public const RETURN_STATUS = 'return';

    public function customer() {
        return $this->belongsTo(Customer::class)->select('id', 'name', 'email', 'phone');
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class)->select('id', 'name', 'email', 'phone', 'address', 'shipping_charge');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->select('id', 'order_id', 'product_id', 'product_name', 'product_price', 'product_qty');
    }

    public function payment() {
        return $this->belongsTo(Payment::class, 'id', 'order_id')->select('id', 'order_id', 'type', 'status');
    }



}
