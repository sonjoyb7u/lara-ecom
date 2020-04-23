<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'user_id', 'message', 'title', 'sub_title', 'image', 'start', 'end', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
