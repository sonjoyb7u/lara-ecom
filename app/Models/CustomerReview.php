<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'message', 'rating', 'status'];

    public const VISIBLE_STATUS = 'visible';
    public const HIDDEN_STATUS = 'hidden';

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
