<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use Exception;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user', 'brand')->get();

        // return $categories;

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $brands = Brand::with('user', 'categories')->get();
        return view('admin.category.create', compact('brands'));
    }

    public function store(CategoryRequest $request, $id)
    {
        $user_id = base64_decode($id);

        $user_detail = User::find($user_id);

        try {
            $category_name = $request->category_name;
            $category_data = [
                'user_id' => $user_id,
                'brand_id' => $request->brand_id,
                'category_name' => $category_name,
                'category_slug' => Str::slug($category_name),
            ];

            // return $category_data;

            $category_create = Category::create($category_data);

            if ($category_create) {
                getMessage('success', 'Category Has Been Added Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.category.index');
                } else {
                    return redirect()->route('admin.category.index');
                }
            }
        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($category_id)
    {
        $category_id = base64_decode($category_id);

        $category_detail = Category::with('user', 'brand')->find($category_id);
        $brand_details = Brand::with('user', 'categories')->get();

        return view('admin.category.edit', compact('category_detail', 'brand_details'));
    }

    public function update(CategoryRequest $request, $category_id)
    {
        $category_id = base64_decode($category_id);

        $category_detail = Category::find($category_id);
        // return $category_detail;
        $user_detail = User::find($category_detail->user_id);
        // return $user_detail;

        try {
            $category_name = $request->category_name;
            $category_detail->user_id = $category_detail->user_id;
            $category_detail->brand_id = $request->brand_id;
            $category_detail->category_name = $category_name;
            $category_detail->category_slug = Str::slug($category_name);

            // return $category_detail;

            $category_update_data = $category_detail->update();

            if ($category_update_data) {
                getMessage('success', 'Category Has Been Updated Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.category.index');
                } else {
                    return redirect()->route('admin.category.index');
                }
            }
        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($category_id)
    {
        $category_id = base64_decode($category_id);

        $category_detail = Category::find($category_id);
        $user_detail = User::find($category_detail->user_id);

        $category_delete = $category_detail->delete();

        if ($category_delete) {
            getMessage('success', 'Category Has Been Deleted Successfully Done.');

            if ($user_detail->is_admin === 1) {
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
    }

    public function updateStatus($category_id, $category_status)
    {
        // return $category_id . ' ' . $category_status;
        $category_detail = Category::find($category_id);
        $user_detail = User::find($category_detail->user_id);

        $category_detail->status = $category_status;

        return $category_update_status = $category_detail->save();

        // if ($brand_update_status) {
        //     // getMessage('success', 'Brand Status Has Been Updated Successfully Done.');

        //     // return redirect()->back();

        //     // if ($user_detail->is_admin === 1) {
        //     //     return redirect()->route('super-admin.brand.index');
        //     // } else {
        //     //     return redirect()->route('admin.brand.index');
        //     // }
        // }
    }
}
