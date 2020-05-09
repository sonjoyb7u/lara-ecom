<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user', 'brand', 'category', 'subCategory')->orderBy('id', 'desc')->get();

        return view('admin.product.index', compact('products'));
    }

    public function create() {
        $brands = Brand::select('id', 'brand_name')->get();
        $categories = Category::select('id', 'category_name')->get();
        $sub_categories = SubCategory::select('id', 'sub_category_name')->get();
        return view('admin.product.create', compact('brands', 'categories', 'sub_categories'));
    }

    public function store(ProductRequest $request, $id) {
//        return $request->all();
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        try {
            $check_file = $request->hasFile('image');
            $image_files = $request->file('image');
//            dd($image_files);


            if ($image_files) {
                $size = ['w'=>700, 'h'=>700];
                $path = 'uploads/images/product/';
                $all_new_images = uploadImage($user_detail, $check_file, $image_files, $size, $path);
                $new_images = json_encode($all_new_images);
//                echo "<pre>";
//                return json_encode($new_images);
//                exit();
                $title = $request->title;
                $product_data = [
                    'user_id' => $user_detail->id,
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'desc' => $request->desc,
                    'code' => $request->code,
                    'available' => $request->available,
                    'image' => $new_images,
                    'quantity' => $request->quantity,
                    'original_price' => $request->original_price,
                    'sales_price' => $request->sales_price,
                    'offer_price' => $request->offer_price,
                    'total_price' => $request->total_price,
                    'is_new' => $request->is_new,
                ];
//             return $product_data;
                Product::create($product_data);

                getMessage('success', 'SUCCESS, Product Has Been Added Successfully Done.');
                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.product.index');
                } else {
                    return redirect()->route('admin.product.index');
                }
            }

        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($product_id)
    {
        $product_id = base64_decode($product_id);
//        return 'Product Id :' . $product_id;

        $brands = Brand::select('id', 'brand_name')->get();
        $categories = Category::select('id', 'category_name')->get();
        $sub_categories = SubCategory::select('id', 'sub_category_name')->get();
        $product_detail = Product::with('user', 'brand', 'category', 'subCategory')->find($product_id);
//        return $product_detail;

        return view('admin.product.edit', compact('brands', 'categories', 'sub_categories',  'product_detail'));
    }

    public function update(ProductRequest $request, $product_id, $user_id)
    {
        $product_id = base64_decode($product_id);
        $user_id = base64_decode($user_id);
//        return 'Product Id :' . $product_id . ' User Id :' . $user_id;

        $product_detail = Product::find($product_id);
        $images = json_decode($product_detail->image);

        $user_detail = User::find($user_id);

        try {
            $check_file = $request->hasFile('image');
            $image_files = $request->file('image');
//            dd($image_files);

            if ($image_files) {
                $size = ['w' => 700, 'h' => 700];
                $path = 'uploads/images/product/';
                $all_new_images = editImage($user_detail, $images, $check_file, $image_files, $size, $path);
                $new_images = json_encode($all_new_images);
//                echo "<pre>";
//                return json_encode($new_images);
//                exit();
                $title = $request->title;
                $product_detail->user_id = $user_detail->id;
                $product_detail->brand_id = $request->brand_id;
                $product_detail->category_id = $request->category_id;
                $product_detail->sub_category_id = $request->sub_category_id;
                $product_detail->title = $title;
                $product_detail->slug = Str::slug($title);
                $product_detail->desc = $request->desc;
                $product_detail->code = $request->code;
                $product_detail->available = $request->available;
                $product_detail->image = $new_images;
                $product_detail->quantity = $request->quantity;
                $product_detail->original_price = $request->original_price;
                $product_detail->sales_price = $request->sales_price;
                $product_detail->offer_price = $request->offer_price;
                $product_detail->total_price = $request->total_price;
                $product_detail->is_new = $request->is_new;

                $product_update_data = $product_detail->update();

                if ($product_update_data) {
                    getMessage('success', 'SUCCESS, Product Has Been Updated Successfully Done With Image.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.product.index');
                    } else {
                        return redirect()->route('admin.product.index');
                    }
                } else {
                    getMessage('danger','ERROR, Product has not been Updated With Image!');
                    return redirect()->back();
                }

            } else {
                $title = $request->title;
                $product_detail->user_id = $user_detail->id;
                $product_detail->brand_id = $request->brand_id;
                $product_detail->category_id = $request->category_id;
                $product_detail->sub_category_id = $request->sub_category_id;
                $product_detail->title = $title;
                $product_detail->slug = Str::slug($title);
                $product_detail->desc = $request->desc;
                $product_detail->code = $request->code;
                $product_detail->available = $request->available;
                $product_detail->quantity = $request->quantity;
                $product_detail->original_price = $request->original_price;
                $product_detail->sales_price = $request->sales_price;
                $product_detail->offer_price = $request->offer_price;
                $product_detail->total_price = $request->total_price;
                $product_detail->is_new = $request->is_new;

                $product_update_data = $product_detail->update();

                if ($product_update_data) {
                    getMessage('success', 'SUCCESS, Product Has Been Updated Successfully Done Without Image.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.product.index');
                    } else {
                        return redirect()->route('admin.product.index');
                    }
                } else {
                    getMessage('danger','ERROR, Product has not been Updated Without Image!');
                    return redirect()->back();
                }

            }

        } catch(Exception $exception) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $exception->getMessage());
            return redirect()->back();

        }


    }

    public function destroy($product_id)
    {
        try {
            $product_id = base64_decode($product_id);
            $product_detail = Product::find($product_id);
//            return $product_detail;
            $images = json_decode($product_detail->image);
//            return $images;
            if($images) {
                foreach ($images as $image) {
//                unlink(public_path('uploads/images/product/') . $image);
                    Storage::disk('public')->delete('/images/product/' . $image);
                }
            }

            $product_delete = $product_detail->delete();
            if ($product_delete) {
                getMessage('success', 'SUCCESS, Product Has Been Deleted Successfully Done.');
                return redirect()->back();

            }

        } catch (Exception $exception) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $exception->getMessage());
            return redirect()->back();
        }


    }

    public function updateStatus($product_id, $product_status)
    {
        // return $product_id . ' ' . $product_status;

        $product_detail = Product::find($product_id);

        $product_detail->status = $product_status;

        return $product_update_status = $product_detail->save();

    }


}
