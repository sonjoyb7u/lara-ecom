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
    //  INDEX/MANAGE PRODUCT...
    public function index()
    {
        $products = Product::with('user', 'brand', 'category', 'subCategory')->latest()->get();
        // return $products;

        return view('admin.product.index', compact('products'));
    }

    //  CREATE/STORE FORM...
    public function create()
    {
        $brands = Brand::select('id', 'brand_name')->get();
        $categories = Category::select('id', 'category_name')->get();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    //  STORE/CREATE PROCESS PRODUCT...
    public function store(ProductRequest $request, $id)
    {
//        return $request->all();
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        try {
            // FOR IMAGE/THUMBNAIL...
            $check_image_file = $request->hasFile('image');
            $image_files = $request->file('image');
//            return $image_files;
            // FOR GALLERY IMAGE...
            $check_gallery_files = $request->hasFile('gallery');
            $gallery_files = $request->file('gallery');
//            return $gallery_files;

            if ($image_files || $gallery_files) {
                $image_size = ['w' => 400, 'h' => 400];
                $gallery_size = ['w' => 300, 'h' => 300];
                $image_path = 'uploads/images/product/images/';
                $gallery_path = 'uploads/images/product/gallery-images/';

                // Calling Helper function...
                $image_name = uploadSingleImage($user_detail, $check_image_file, $image_files, $image_size, $image_path);
                $all_gallery_images = uploadGalleryImage($user_detail, $check_gallery_files, $gallery_files, $gallery_size, $gallery_path);

                $gallery_images = json_encode($all_gallery_images);
//                echo "<pre>";
//                print_r(json_encode($gallery_images));
//                echo "</pre>";
//                exit();

                $title = $request->title;
                $product_colors = json_encode($request->product_color);
//                return $product_colors;
                $product_data = [
                    'user_id' => $user_detail->id,
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'desc' => $request->desc,
                    'long_desc' => $request->long_desc,
                    'product_code' => $request->product_code,
                    'product_model' => $request->product_model,
                    'product_color' => $product_colors,
                    'product_size' => $request->product_size,
                    'image' => $image_name,
                    'image_start' => $request->image_start,
                    'image_end' => $request->image_end,
                    'gallery' => $gallery_images,
                    'product_video_url' => $request->product_video_url,
                    'quantity' => $request->quantity,
                    'warranty' => $request->warranty,
                    'warranty_duration' => $request->warranty_duration,
                    'warranty_condition' => $request->warranty_condition,
                    'original_price' => $request->original_price,
                    'sales_price' => $request->sales_price,
                    'is_special_price' => $request->is_special_price,
                    'special_price' => $request->special_price,
                    'special_start' => $request->special_start,
                    'special_end' => $request->special_end,
                    'is_offer_price' => $request->is_offer_price,
                    'offer_price' => $request->offer_price,
                    'offer_start' => $request->offer_start,
                    'offer_end' => $request->offer_end,
                    'available' => $request->available,
                    'status' => $request->status,
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

    //  EDIT FORM PRODUCT...
    public function edit($product_id)
    {
        $product_id = base64_decode($product_id);
//        return 'Product Id :' . $product_id;
        $brands = Brand::select('id', 'brand_name')->get();
        $categories = Category::select('id', 'category_name')->get();

        $product_detail = Product::with('user', 'brand', 'category', 'subCategory')->find($product_id);
//        return $product_detail;
        $cat_wise_subcats = SubCategory::where('category_id', $product_detail->category_id)->get();
//        return $cat_wise_subcats;

        return view('admin.product.edit', compact('brands', 'categories', 'cat_wise_subcats', 'product_detail'));
    }

    //  UPDATE PROCESS PRODUCT...
    public function update(ProductRequest $request, $product_id, $user_id)
    {
        $product_id = base64_decode($product_id);
        $user_id = base64_decode($user_id);
//        return 'Product Id :' . $product_id . ' User Id :' . $user_id;

        $product_detail = Product::find($product_id);
        $images = json_decode($product_detail->image);
        $gallery_images = json_decode($product_detail->gallery);
//        echo "<pre>";
//        print_r($images);
//        print_r($gallery_images);
//        exit();

        $user_detail = User::find($user_id);

        try {
            // FOR IMAGE/THUMBNAIL...
            $check_image_file = $request->hasFile('image');
            $image_files = $request->file('image');
//            return $image_files;
            // FOR GALLERY IMAGE...
            $check_gallery_files = $request->hasFile('gallery');
            $gallery_files = $request->file('gallery');
//            return $gallery_files;

            if ($image_files || $gallery_files) {
                $image_size = ['w' => 400, 'h' => 400];
                $gallery_size = ['w' => 300, 'h' => 300];
                $image_path = 'uploads/images/product/images/';
                $gallery_path = 'uploads/images/product/gallery-images/';

                if ($image_files) {
                    $all_images_name = editImage($user_detail, $images, $check_image_file, $image_files, $image_size, $image_path);
                    $images = json_encode($all_images_name);
                }
                if ($gallery_files) {
                    $all_gallery_images = editGalleryImage($user_detail, $gallery_images, $check_gallery_files, $gallery_files, $gallery_size, $gallery_path);
                    $gallery_images = json_encode($all_gallery_images);
                }

//                echo "<pre>";
//                print_r(json_encode($images));
//                print_r(json_encode($gallery_images));
//                echo "</pre>";
//                exit();

                $title = $request->title;
                $product_detail->user_id = $user_detail->id;
                $product_detail->brand_id = $request->brand_id;
                $product_detail->category_id = $request->category_id;
                $product_detail->sub_category_id = $request->sub_category_id;
                $product_detail->title = $title;
                $product_detail->slug = Str::slug($title);
                $product_detail->desc = $request->desc;
                $product_detail->long_desc = $request->long_desc;
                $product_detail->product_code = $request->product_code;
                $product_detail->product_model = $request->product_model;
                $product_detail->product_color = $request->product_color;
                $product_detail->product_size = $request->product_size;
                $product_detail->available = $request->available;
                $product_detail->image = $images;
                $product_detail->image_start = $request->image_start;
                $product_detail->image_end = $request->image_end;
                $product_detail->gallery = $gallery_images;
                $product_detail->product_video_url = $request->product_video_url;
                $product_detail->quantity = $request->quantity;
                $product_detail->warranty = $request->warranty;
                $product_detail->warranty_duration = $request->warranty_duration;
                $product_detail->warranty_condition = $request->warranty_condition;
                $product_detail->original_price = $request->original_price;
                $product_detail->sales_price = $request->sales_price;
                $product_detail->is_special_price = $request->is_special_price;
                $product_detail->special_price = $request->special_price;
                $product_detail->special_start = $request->special_start;
                $product_detail->special_end = $request->special_end;
                $product_detail->is_offer_price = $request->is_offer_price;
                $product_detail->offer_price = $request->offer_price;
                $product_detail->offer_start = $request->offer_start;
                $product_detail->offer_end = $request->offer_end;
                $product_detail->available = $request->available;
                $product_detail->status = $request->status;

                $product_update_data = $product_detail->update();

                if ($product_update_data) {
                    getMessage('success', 'SUCCESS, Product Has Been Updated Successfully Done With Image.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.product.index');
                    } else {
                        return redirect()->route('admin.product.index');
                    }
                } else {
                    getMessage('danger', 'ERROR, Product has not been Updated With Image!');
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
                $product_detail->long_desc = $request->long_desc;
                $product_detail->product_code = $request->product_code;
                $product_detail->product_model = $request->product_model;
                $product_detail->product_color = $request->product_color;
                $product_detail->product_size = $request->product_size;
                $product_detail->available = $request->available;
                $product_detail->image_start = $request->image_start;
                $product_detail->image_end = $request->image_end;
                $product_detail->product_video_url = $request->product_video_url;
                $product_detail->quantity = $request->quantity;
                $product_detail->warranty = $request->warranty;
                $product_detail->warranty_duration = $request->warranty_duration;
                $product_detail->warranty_condition = $request->warranty_condition;
                $product_detail->original_price = $request->original_price;
                $product_detail->sales_price = $request->sales_price;
                $product_detail->is_special_price = $request->is_special_price;
                $product_detail->special_price = $request->special_price;
                $product_detail->special_start = $request->special_start;
                $product_detail->special_end = $request->special_end;
                $product_detail->is_offer_price = $request->is_offer_price;
                $product_detail->offer_price = $request->offer_price;
                $product_detail->offer_start = $request->offer_start;
                $product_detail->offer_end = $request->offer_end;
                $product_detail->available = $request->available;
                $product_detail->status = $request->status;

                $product_update_data = $product_detail->update();

                if ($product_update_data) {
                    getMessage('success', 'SUCCESS, Product Has Been Updated Successfully Done Without Image.');

                    if ($user_detail->is_admin === 1) {
                        return redirect()->route('super-admin.product.index');
                    } else {
                        return redirect()->route('admin.product.index');
                    }
                } else {
                    getMessage('danger', 'ERROR, Product has not been Updated Without Image!');
                    return redirect()->back();
                }
            }
        } catch (Exception $exception) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $exception->getMessage());
            return redirect()->back();
        }
    }

//    DESTROY/DELETE PROCESS PRODUCT...
    public function destroy($product_id)
    {
        try {
            $product_id = base64_decode($product_id);
            $product_detail = Product::find($product_id);
//            return $product_detail;

            $images = json_decode($product_detail->image);
//            return $images;
            $gallery_images = json_decode($product_detail->gallery);
//            return $gallery_images;

            if (!empty($images)) {
                foreach ($images as $image) {
//                unlink(public_path('uploads/images/product/') . $image);
                    Storage::disk('public')->delete('/images/product/images/' . $image);
                }
            }
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $gallery_image) {
//                unlink(public_path('uploads/images/product/') . $image);
                    Storage::disk('public')->delete('/images/product/gallery-images/' . $gallery_image);
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

    //  UPDATE STATUS PROCESS ACTIVE/INACTIVE PRODUCT...
    public function updateStatus($product_id, $product_status)
    {
        // return $product_id . ' ' . $product_status;
        $product_detail = Product::find($product_id);

        $product_detail->status = $product_status;
        $product_detail->save();
    }

    //  FIND & FETCH CATEGORY WISE SUB-CATEGORY PRODUCT...
    public function findCatWiseSubCat($cat_id)
    {
//        return $cat_id;
        $sub_categories = SubCategory::select('id', 'sub_category_name')->where('category_id', $cat_id)->get();
//        return $sub_categories;
        echo '<option value="">Select Sub-Category Name</option>';
        foreach ($sub_categories as $sub_category) {
            echo '<option value="' . $sub_category->id . '">' . $sub_category->sub_category_name . '</option>';
        }
    }

    //  UPDATED GET WISE(using Ajax)  PROCESS ORIGINAL PRICE PRODUCT...
    public function updateOriginalPrice($id, $price)
    {
//        return $id . ' ' . $price;
        $product = Product::select('id', 'original_price')->find($id);
//        return $product;
        $product->original_price = $price;
        $product->save();
    }

    //  UPDATED POST WISE(using Ajax) PROCESS SALES PRICE PRODUCT...
    public function updateSalesPrice(Request $request)
    {
//        dd($request->all());
//        return $id . ' ' . $price;
        $product = Product::select('id', 'sales_price')->find($request->id);
//        return $product;
        $product->sales_price = $request->price;
        $product->update();
    }

    //  UPDATED PROCESS SPECIAL PRICE PRODUCT...
    public function updateSpecialPrice($id, $price)
    {
//        return $id . ' ' . $price;
        $product = Product::select('id', 'special_price')->find($id);
//        return $product;
        $product->special_price = $price;
        $product->save();
    }

    //  UPDATED PROCESS OFFER PRICE PRODUCT...
    public function updateOfferPrice($id, $price)
    {
//        return $id . ' ' . $price;
        $product = Product::select('id', 'offer_price')->find($id);
//        return $product;
        $product->offer_price = $price;
        $product->save();
    }
}
