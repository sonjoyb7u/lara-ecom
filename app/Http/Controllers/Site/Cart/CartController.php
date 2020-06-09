<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();
        $categories = Category::with('user', 'subCategories')->get();

//      Left side New Special Deal products showing...
        $no_special_price = null;
        $special_deal_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('status',Product::ACTIVE_STATUS)
            ->where('special_price', '<>', $no_special_price)
            ->latest()
            ->get();
//        return $special_deal_products;

        //Left side New products showing...
        $new_special_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('status',Product::ACTIVE_STATUS)
            ->limit(10)
            ->latest()
            ->get();
//        return $new_special_products;

        View::share(['brands'=>$brands, 'categories'=>$categories, 'new_special_products'=>$new_special_products,  'special_deal_products'=>$special_deal_products]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
//        $cart_item = \Cart::getContent();
//        return $cart_item;

        return view('site.cart.show');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCart(Request $request) {

        $product_id = Product::where('slug', $request->slug)->pluck('id');
//        return $product_id;

        $cart_item = Product::with('user', 'brand', 'category', 'subCategory')->select('id', 'title', 'slug', 'product_code', 'product_model', 'product_color', 'product_size', 'image', 'image_start', 'image_end', 'quantity', 'sales_price', 'special_price', 'special_start', 'special_end')->find($product_id)->first();
//        return $cart_item;

        $special_price = false;
        if($cart_item->special_start <= date('Y-m-d') && $cart_item->special_end >= date('Y-m-d')) {
            $special_price = true;
        }
        // Add the Product to cart...
        $cart_item = \Cart::add([
            'id' => $cart_item->id,
            'name' => $cart_item->title,
            'price' => $special_price ? $cart_item->special_price : $cart_item->sales_price,
            'quantity' => 1,
            'attributes' => [
                'sales_price' => $cart_item->sales_price,
                'special_price' => $cart_item->special_price,
                'special_start' => $cart_item->special_start,
                'special_end' => $cart_item->special_end,
                'slug' => $cart_item->slug,
                'image' => $cart_item->image,
            ],
//            'attributes' => array([
//                'image' => $cart_item->image,
//            ]),
        ]);

        if($cart_item) {
            Toastr::success('Your Cart Item has been Added Success, Please Check It.', 'Success');
            return redirect()->back();
//        return redirect()->route('site.cart.show')->with('message', 'Your Item Added to the Cart.');
        } else {
            Toastr::error('Your Cart Item has Not been Added, Something Wrong!', 'Error');
            return redirect()->back();

        }


    }

    /**
     * @param Request $request
     */

    public function addSingleProductCart(Request $request) {
        $product_id = Product::where('slug', $request->slug)->pluck('id');
//        return $product_id;
        $quantity = $request->quantity;

        $cart_item = Product::with('user', 'brand', 'category', 'subCategory')->select('id', 'title', 'slug', 'product_code', 'product_model', 'product_color', 'product_size', 'image', 'image_start', 'image_end', 'quantity', 'sales_price', 'special_price', 'special_start', 'special_end')->find($product_id)->first();
//        return $cart_item;

        $special_price = false;
        if($cart_item->special_start <= date('Y-m-d') && $cart_item->special_end >= date('Y-m-d')) {
            $special_price = true;
        }
        // Add the Product to cart...
        $cart_item = \Cart::add([
            'id' => $cart_item->id,
            'name' => $cart_item->title,
            'price' => $special_price ? $cart_item->special_price : $cart_item->sales_price,
            'quantity' => $quantity,
            'attributes' => [
                'sales_price' => $cart_item->sales_price,
                'special_price' => $cart_item->special_price,
                'special_start' => $cart_item->special_start,
                'special_end' => $cart_item->special_end,
                'slug' => $cart_item->slug,
                'image' => $cart_item->image,
            ],
//            'attributes' => array([
//                'image' => $cart_item->image,
//            ]),
        ]);

        if($cart_item) {
            Toastr::success('Your Cart Item has been Added Success, Please Check It.', 'Success');
            return redirect()->back();
//        return redirect()->route('site.cart.show')->with('message', 'Your Item Added to the Cart.');
        } else {
            Toastr::error('Your Cart Item has Not been Added, Something Wrong!', 'Error');
            return redirect()->back();

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCart(Request $request) {
        $cart_delete = \Cart::remove($request->id);

        if($cart_delete) {
            Toastr::success('Your Cart Item has been Deleted Success.', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Your Cart Item has Not been Deleted, Something Wrong!', 'Error');
            return redirect()->back();
        }

    }

    public function updateCart(Request $request) {
//        $quantity_detail = $request->all();
//        $product_id = $quantity_detail['product_id'];
//        $quantity = $quantity_detail['quantity'];
//
//        $product_detail = Product::with('user', 'brand', 'category', 'subCategory')->where('id', $product_id)->select('sales_price', 'special_price', 'special_start', 'special_end')->first();
//
//        $special_price = false;
//        if($product_detail->special_start <= date('Y-m-d') && $product_detail->special_end >= date('Y-m-d')) {
//            $special_price = true;
//        }
//        $price = $special_price ? $product_detail->special_price : $product_detail->sales_price;
//        $grand_total_price = $quantity * $price;
//        echo $grand_total_price;
//        echo '<td class="text-center">&#2547;&nbsp;' . $grand_total_price . '</td>';

        // update the item on cart...
        $cart_update = \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity,
            ],

        ]);

        if($cart_update) {
            Toastr::success('Your Cart Item has been Updated Success.', 'Success');
            echo 'Success, Your Cart Item has been Updated Success.';
            return redirect()->back();
        } else {
            Toastr::error('Your Cart Item has Not been Updated, Something Wrong!', 'Error');                     echo 'Failed, Your Cart Item has not been Updated, Something Wrong!!';
            return redirect()->back();
        }

    }

    public function updateGrandTotalPrice(Request $request) {

    }


}
