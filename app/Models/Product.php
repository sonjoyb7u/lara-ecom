<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id' ,'brand_id', 'category_id', 'sub_category_id', 'title', 'slug', 'desc', 'code', 'available', 'image', 'quantity', 'original_price', 'sales_price', 'offer_price', 'total_sales', 'is_new', 'status',
    ];

    public const ACTIVE_STATUS = 'active';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }
}
