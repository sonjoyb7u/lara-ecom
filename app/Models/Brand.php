<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'user_id', 'brand_name', 'brand_slug', 'status',
    ];

    public const ACTIVE_BRAND = 1;
    public const INACTIVE_BRAND = 0;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
