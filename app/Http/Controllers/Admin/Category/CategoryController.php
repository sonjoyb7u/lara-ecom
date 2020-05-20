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
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('user')->latest()->get();
        // return $categories;

        return view('admin.category.index', compact('categories'));
    }

//    SHOW CREATE CATEGORY FORM...
    public function create()
    {
        return view('admin.category.create');
    }

//    CREATE/ADD CATEGORY PROCESSING...
    public function store(CategoryRequest $request, $id)
    {
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        try {
            $image_file = $request->file('banner');
            if(!empty($image_file)) {
                $image_file_ext = $image_file->getClientOriginalExtension();
                $new_image_name  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//                return $new_image_name;
                $image_file_type = $image_file->getMimeType();
            }

            $category_name = $request->category_name;
            $category_data = [
                'user_id' => $user_id,
                'category_name' => $category_name,
                'category_slug' => Str::slug($category_name),
                'banner' => $new_image_name,
                'logo' => $request->logo,
            ];

//             return $category_data;

            if($image_file->isValid()) {
                if ($image_file_type === "image/jpeg" || $image_file_type === "image/png") {
                    $category_create = Category::create($category_data);
                    if ($category_create) {
//                        $image_file->storeAs('/images/category/', $new_image_name);
//                        $image_file->move('uploads/images/category/', $new_image_name);
                        Image::make($image_file)
                            ->resize(870, 370)
                            ->save(public_path('uploads/images/category/') . $new_image_name);
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

//    SHOW EDIT CATEGORY FORM...
    public function edit($category_id)
    {
        $category_id = base64_decode($category_id);
//        return 'Cat Id :' . $category_id;
        $category_detail = Category::with('user')->find($category_id);

        return view('admin.category.edit', compact('category_detail'));
    }

//    UPDATED CATEGORY PROCESSING...
    public function update(CategoryRequest $request, $category_id, $user_id)
    {
        $category_id = base64_decode($category_id);
        $user_id = base64_decode($user_id);
//        return 'Cat Id :' . $category_id . ' User Id :' . $user_id;
        $category_detail = Category::find($category_id);
//         return $category_detail->image;
        $user_detail = User::find($user_id);

        $check_has_file = $request->hasFile('banner');
        if($check_has_file) {
            $image_file = $request->file('banner');
            if(!empty($image_file)) {
                $image_file_ext = $image_file->getClientOriginalExtension();
                $new_image_name  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//            return $new_image_file;
                $image_file_type = $image_file->getMimeType();

                if($image_file->isValid()) {
                    if($image_file_type === "image/jpeg" || $image_file_type === "image/png") {

//                    unlink(public_path('uploads/images/category/'.$category_detail->banner));
                        Storage::disk('public')->delete('/images/category/'.$category_detail->banner);

                        $category_name = $request->category_name;
                        $category_detail->user_id = $user_detail->id;
                        $category_detail->category_name = $category_name;
                        $category_detail->category_slug = Str::slug($category_name);
                        $category_detail->banner = $new_image_name;
                        $category_detail->logo = $request->logo;

                        $category_update_data = $category_detail->update();

                        if ($category_update_data) {
//                        $image_file->storeAs('/images/category/', $new_image_file);
//                            $image_file->move('uploads/images/category/', $new_image_name);
                            Image::make($image_file)
                                ->resize(870, 370)
                                ->save(public_path('uploads/images/category/') . $new_image_name);

                            getMessage('success', 'SUCCESS, Category Has Been Updated Successfully Done With an Image.');

                            if ($user_detail->is_admin === 1) {
                                return redirect()->route('super-admin.category.index');
                            } else {
                                return redirect()->route('admin.category.index');
                            }
                        } else {
                            getMessage('danger','ERROR, Category has not been Updated With an Image!');
                            return redirect()->back();
                        }

                    }

                }

            }

        } else {
            $category_name = $request->category_name;
            $category_detail->user_id = $user_detail->id;
            $category_detail->category_name = $category_name;
            $category_detail->category_slug = Str::slug($category_name);
            $category_detail->logo = $request->logo;

            $category_update_data = $category_detail->update();

            if ($category_update_data) {
                getMessage('success', 'SUCCESS, Category Has Been Updated Successfully Done Without an Image.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.category.index');
                } else {
                    return redirect()->route('admin.category.index');
                }
            } else {
                getMessage('danger','ERROR, Category has not been Updated Without an Image!');
                return redirect()->back();
            }

        }

    }

//    DESTROY/DELETE CATEGORY PROCESSING...
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

//    UPDATED CATEGORY STATUS ACTIVE/INACTIVE PROCESSING...
    public function updateStatus($category_id, $category_status)
    {
        // return $category_id . ' ' . $category_status;
        $category_detail = Category::find($category_id);

        $category_detail->status = $category_status;
        $category_detail->save();

    }
}
