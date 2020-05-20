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
        $sub_categories = SubCategory::with('user', 'category')->latest()->get();
//         return $sub_categories;

        return view('admin.sub-category.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('admin.sub-category.create', compact( 'categories'));
    }

//    CREATE/ADD SUB CATEGORY PROCESSING...
    public function store(SubCategoryRequest $request, $id)
    {
//        return $request->all();
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        try {
            $check_image_file = $request->hasFile('banner');
            $image_file = $request->file('banner');
//            dd($image_file);

            if ($image_file) {
                $image_size = ['w'=>870, 'h'=>370];
                $image_path = 'uploads/images/sub-category/';
                $new_image = uploadSingleImage($user_detail, $check_image_file, $image_file, $image_size, $image_path);

                $sub_category_name = $request->sub_category_name;
                $sub_category_data = [
                    'user_id' => $user_id,
                    'category_id' => $request->category_id,
                    'sub_category_name' => $sub_category_name,
                    'sub_category_slug' => Str::slug($sub_category_name),
                    'banner' => $new_image,
                ];
//              return $sub_category_data;
                SubCategory::create($sub_category_data);

                getMessage('success', 'SUCCESS, Sub Category Has Been Added Successfully Done.');
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


//    SHOW EDIT SUB CATEGORY FORM...
    public function edit($sub_category_id)
    {
        $sub_category_id = base64_decode($sub_category_id);
//        return 'Sub-Cat Id :' . $sub_category_id;
        $categories = Category::select('id', 'category_name')->orderBy('category_name', 'asc')->get();
//        return $categories;
        $sub_category_detail = SubCategory::with('user', 'category')->find($sub_category_id);
//        return $sub_category_detail;

        return view('admin.sub-category.edit', compact('sub_category_detail', 'categories'));

    }


//    UPDATE SUB CATEGORY PROCESSING...
    public function update(SubCategoryRequest $request, $sub_category_id, $user_id)
    {
        $sub_category_id = base64_decode($sub_category_id);
        $user_id = base64_decode($user_id);
//        return 'Cat Id :' . $sub_category_id . ' User Id :' . $user_id;

        $sub_category_detail = SubCategory::find($sub_category_id);
        $user_detail = User::find($user_id);

        $image = $sub_category_detail->banner;

        try {
            $check_image_file = $request->hasFile('banner');
            $image_file = $request->file('banner');
//            dd($image_file);

            if ($image_file) {
                $image_size = ['w' => 870, 'h' => 370];
                $image_path = 'uploads/images/sub-category/';
                $new_image = editSingleImage($user_detail, $image, $check_image_file, $image_file, $image_size, $image_path);

                $sub_category_name = $request->sub_category_name;

                $sub_category_detail->user_id = $user_detail->id;
                $sub_category_detail->category_id = $request->category_id;
                $sub_category_detail->sub_category_name = $sub_category_name;
                $sub_category_detail->sub_category_slug = Str::slug($sub_category_name);
                $sub_category_detail->banner = $new_image;
//              return $sub_category_detail;

                $sub_category_update_data = $sub_category_detail->update();

                if ($sub_category_update_data) {
                    getMessage('success', 'SUCCESS, Sub Category Has Been Updated Successfully Done with Banner.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.sub-category.index');
                    } else {
                        return redirect()->route('admin.sub-category.index');
                    }
                } else {
                    getMessage('danger','ERROR, Sub Category has not been Updated With Image!');
                    return redirect()->back();
                }

            } else {
                $sub_category_name = $request->sub_category_name;

                $sub_category_detail->user_id = $user_detail->id;
                $sub_category_detail->category_id = $request->category_id;
                $sub_category_detail->sub_category_name = $sub_category_name;
                $sub_category_detail->sub_category_slug = Str::slug($sub_category_name);
//              return $sub_category_detail;

                $sub_category_update_data = $sub_category_detail->update();

                if ($sub_category_update_data) {
                    getMessage('success', 'SUCCESS, Sub Category Has Been Updated Successfully Done Without Image.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.sub-category.index');
                    } else {
                        return redirect()->route('admin.sub-category.index');
                    }
                } else {
                    getMessage('danger','ERROR, Sub Category has not been Updated Without Image!');
                    return redirect()->back();
                }

            }

        } catch(Exception $exception) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $exception->getMessage());
            return redirect()->back();

        }

    }


//    DESTROY/DELETE SUB CATEGORY PROCESSING...
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
