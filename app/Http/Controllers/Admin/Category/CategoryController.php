<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user', 'brand')->latest()->get();

        // return $categories;

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $brands = Brand::orderBy('brand_name', 'asc')->get();

        return view('admin.category.create', compact('brands'));
    }

    public function store(CategoryRequest $request, $id)
    {
        $user_id = base64_decode($id);

        $user_detail = User::find($user_id);

        $image_file = $request->file('image');
        $image_file_ext = $image_file->getClientOriginalExtension();
        $new_image_file  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//        return $new_image_file;

        $image_file_type = $image_file->getMimeType();

        try {
            $category_name = $request->category_name;
            $category_data = [
                'user_id' => $user_id,
                'brand_id' => $request->brand_id,
                'category_name' => $category_name,
                'category_slug' => Str::slug($category_name),
                'image' => $new_image_file,
            ];

//             return $category_data;

            if($image_file->isValid()) {
                if ($image_file_type == "image/jpeg" || $image_file_type == "image/png") {

                    $category_create = Category::create($category_data);

                    if ($category_create) {
//                    $image_file->storeAs('/images/category/', $new_image_file);
                        $image_file->move('uploads/images/category/', $new_image_file);
                        getMessage('success', 'SUCCESS, Category Has Been Added Successfully Done.');

                        if ($user_detail->is_admin === 1) {
                            return redirect()->route('super-admin.category.index');
                        } else {
                            return redirect()->route('admin.category.index');
                        }
                    }

                }

            }

        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $e->getMessage());
            return redirect()->back();
        }

    }

    public function edit($category_id)
    {
        $category_id = base64_decode($category_id);
//        return 'Cat Id :' . $category_id;

        $category_detail = Category::with('user', 'brand')->find($category_id);
        $brand_details = Brand::with('user', 'categories')->get();

        return view('admin.category.edit', compact('category_detail', 'brand_details'));
    }

    public function update(CategoryRequest $request, $category_id, $user_id)
    {
        $category_id = base64_decode($category_id);
        $user_id = base64_decode($user_id);
//        return 'Cat Id :' . $category_id . ' User Id :' . $user_id;

        $category_detail = Category::find($category_id);
//         return $category_detail->image;
        $user_detail = User::find($user_id);

        if($request->file('image')) {
            $image_file = $request->file('image');
            $image_file_ext = $image_file->getClientOriginalExtension();
            $new_image_file  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//            return $new_image_file;
            $image_file_type = $image_file->getMimeType();

            if($image_file->isValid()) {
                if($image_file_type == "image/jpeg" || $image_file_type == "image/png") {

//                    unlink(public_path('uploads/images/category/'.$category_detail->image));
                    Storage::disk('public')->delete('/images/category/'.$category_detail->image);

                    $category_name = $request->category_name;
                    $category_detail->user_id = $user_detail->id;
                    $category_detail->brand_id = $request->brand_id;
                    $category_detail->category_name = $category_name;
                    $category_detail->category_slug = Str::slug($category_name);
                    $category_detail->image = $new_image_file;

                    $category_update_data = $category_detail->update();

                    if ($category_update_data) {
//                        $image_file->storeAs('/images/category/', $new_image_file);
                        $image_file->move('uploads/images/category/', $new_image_file);

                        getMessage('success', 'SUCCESS, Category Has Been Updated With Image Successfully Done.');

                        if ($user_detail->is_admin === 1) {
                            return redirect()->route('super-admin.category.index');
                        } else {
                            return redirect()->route('admin.category.index');
                        }
                    } else {
                        getMessage('danger','ERROR, Category has not been Updated With Image!');
                        return redirect()->back();
                    }


                }

            }

        } else {
            $category_name = $request->category_name;
            $category_detail->user_id = $user_detail->id;
            $category_detail->brand_id = $request->brand_id;
            $category_detail->category_name = $category_name;
            $category_detail->category_slug = Str::slug($category_name);

            $category_update_data = $category_detail->update();

            if ($category_update_data) {
                getMessage('success', 'SUCCESS, Category Has Been Updated With Image Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.category.index');
                } else {
                    return redirect()->route('admin.category.index');
                }
            } else {
                getMessage('danger','ERROR, Category has not been Updated With Image!');
                return redirect()->back();
            }

        }

//        try {
//            $image_file = $request->file('image');
//            $image_file_ext = $image_file->getClientOriginalExtension();
//            $new_image_file  = $user_detail->user_name . "_" . date("Ymdhis") . "_" . rand(9999, 99999) . "." . $image_file_ext;
//            $image_file_type = $image_file->getMimeType();
//
//
//
//             return $category_detail;
//
//            if($image_file) {
//
//
//            }
//
////            $category_update_data = $category_detail->update();
//
//
//        } catch (Exception $e) {
//            // return 'Error : ' . $e->getMessage();
//            getMessage('danger', $e->getMessage());
//            return redirect()->back();
//        }
    }

    public function destroy($category_id)
    {
        $category_id = base64_decode($category_id);

        $category_detail = Category::find($category_id);

        Storage::disk('public')->delete('/images/category/'.$category_detail->image);

        $category_delete = $category_detail->delete();

        if ($category_delete) {
            getMessage('success', 'Category Has Been Deleted Successfully Done.');

            return redirect()->back();

        }

    }

    public function updateStatus($category_id, $category_status)
    {
        // return $category_id . ' ' . $category_status;

        $category_detail = Category::find($category_id);

        $category_detail->status = $category_status;

        return $category_update_status = $category_detail->save();

    }
}
