<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = SubCategory::with('user', 'brand', 'category')->latest()->get();
//         return $sub_categories;

        return view('admin.sub-category.index', compact('sub_categories'));
    }

    public function create()
    {
        $brands = Brand::orderBy('brand_name', 'asc')->get();
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('admin.sub-category.create', compact('brands', 'categories'));
    }


    public function store(SubCategoryRequest $request, $id)
    {
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        try {
            $sub_category_name = $request->sub_category_name;
            $sub_category_data = [
                'user_id' => $user_id,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'sub_category_name' => $sub_category_name,
                'sub_category_slug' => Str::slug($sub_category_name),
            ];

//             return $sub_category_data;

            $sub_category_create = SubCategory::create($sub_category_data);

            if ($sub_category_create) {

                getMessage('success', 'SUCCESS, Sub-Category Has Been Added Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.sub-category.index');
                } else {
                    return redirect()->route('admin.sub-category.index');
                }
            }

        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $e->getMessage());
            return redirect()->back();
        }

    }

    public function edit($sub_category_id)
    {
        $sub_category_id = base64_decode($sub_category_id);
//        return 'Sub-Cat Id :' . $sub_category_id;

        $sub_category_detail = SubCategory::with('user', 'brand', 'category')->find($sub_category_id);
        $brand_details = Brand::with('user', 'categories')->orderBy('brand_name', 'asc')->get();
        $category_details = Category::with('user', 'brand', 'subCategories')->orderBy('category_name', 'asc')->get();

        return view('admin.sub-category.edit', compact('sub_category_detail', 'brand_details', 'category_details'));
    }

    public function update(SubCategoryRequest $request, $sub_category_id, $user_id)
    {
        $sub_category_id = base64_decode($sub_category_id);
        $user_id = base64_decode($user_id);
//        return 'Cat Id :' . $sub_category_id . ' User Id :' . $user_id;

        $sub_category_detail = SubCategory::find($sub_category_id);
        $user_detail = User::find($user_id);

        try {
            $sub_category_name = $request->sub_category_name;

            $sub_category_detail->user_id = $user_detail->id;
            $sub_category_detail->brand_id = $request->brand_id;
            $sub_category_detail->category_id = $request->category_id;
            $sub_category_detail->sub_category_name = $sub_category_name;
            $sub_category_detail->sub_category_slug = Str::slug($sub_category_name);

//            return $sub_category_detail;

            $sub_category_update_data = $sub_category_detail->update();

            if ($sub_category_update_data) {

                getMessage('success', 'SUCCESS, Sub-Category Has Been Updated Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.sub-category.index');
                } else {
                    return redirect()->route('admin.sub-category.index');
                }
            }

        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $e->getMessage());
            return redirect()->back();
        }


    }


    public function destroy($sub_category_id)
    {
        $sub_category_id = base64_decode($sub_category_id);

        $sub_category_detail = SubCategory::find($sub_category_id);

//        Storage::disk('public')->delete('/images/category/'.$sub_category_detail->image);

        $sub_category_delete = $sub_category_detail->delete();

        if ($sub_category_delete) {
            getMessage('success', 'Sub-Category Has Been Deleted Successfully Done.');

            return redirect()->back();

        }

    }

    public function updateStatus($sub_category_id, $sub_category_status)
    {
        // return $sub_category_id . ' ' . $sub_category_status;

        $sub_category_detail = SubCategory::find($sub_category_id);

        $sub_category_detail->status = $sub_category_status;

        $sub_category_detail->save();

    }
}
