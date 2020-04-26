<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        $sliders = Slider::with('user')->orderBy('id', 'desc')
            ->where('start', '<=', date('Y-m-d h:i:s'))
            ->where('end', '>=', date('Y-m-d h:i:s'))
            ->where('status', Slider::ACTIVE_STATUS)
            ->get();

        return view('site.index', compact('sliders'));
    }
}
