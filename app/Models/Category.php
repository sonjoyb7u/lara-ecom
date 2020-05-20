<?php

namespace App\Models;

use App\Models\SubCategory;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = [
        'user_id', 'category_name', 'category_slug', 'banner', 'logo', 'status',
    ];

    public const ACTIVE_STATUS = 1;
    public const INACTIVE_STATUS = 0;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class)->where('status', SubCategory::ACTIVE_STATUS);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }


}
