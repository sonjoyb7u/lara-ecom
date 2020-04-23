<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Brand;
use App\Models\SubCategory;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'brand_id', 'category_name', 'category_slug', 'image', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
