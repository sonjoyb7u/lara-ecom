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
        'user_id' ,'brand_id', 'category_id', 'sub_category_id', 'title', 'slug', 'desc', 'long_desc', 'product_code', 'product_model', 'product_color', 'product_size', 'image', 'image_start', 'image_end', 'gallery', 'product_video_url', 'quantity', 'warranty', 'warranty_duration', 'warranty_condition', 'original_price', 'sales_price', 'special_price', 'special_start', 'special_end', 'offer_price', 'offer_start', 'offer_end', 'is_featured', 'is_new', 'available', 'status',
    ];

    public const ACTIVE_STATUS = 'active';
    public const FEATURED = 'yes';
    public const NEW_ARRIVAL = 'yes';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->where('status', Brand::ACTIVE_BRAND);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id')->where('status', Category::ACTIVE_STATUS);
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id')->where('status', SubCategory::ACTIVE_STATUS);
    }

    public function orderItems() {
        return $this->hasMany(Product::class);
    }
}
