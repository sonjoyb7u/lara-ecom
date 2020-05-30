<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class PracticeTestController extends Controller
{
    public function fatchCatData() {
        return view('practice.fetch-cat-data');
    }

    public function loadCatData(Request $request) {
        if($request->ajax()) {
            if($request->id) {
                $categories = Category::where('id', '<', $request->id)->latest()->limit(2)->get();
//                foreach ($categories as $key => $category) {
//                    echo $key . ' => ' . $category;
//                }
            } else {
                $categories = Category::latest()->limit(2)->get();
//                foreach ($categories as $key => $category) {
//                    echo $key . ' => ' . $category;
//                }
            }

        }
        return view('practice.load-cat-data', compact('categories'));

    }

}
