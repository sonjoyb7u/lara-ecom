<?php

namespace App\Http\Controllers\Site\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\Mail\WelcomeCustomer;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipping;
use Brian2694\Toastr\Facades\Toastr;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();

        View::share(['brands' => $brands]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkoutLogin()
    {
        $customer_id = Session::get('customer_id');
        if(\Cart::getTotalQuantity() < 1 && !$customer_id) {
            $redirect = redirect()->route('site.index');

        } elseif($customer_id && \Cart::getTotalQuantity() > 0) {
            $redirect = redirect()->route('site.checkout.customer-shipping.info');

        } else {
            $redirect = view('site.checkout.login');
        }
        return $redirect;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutRegister()
    {
        $customer_id = Session::get('customer_id');
        if(\Cart::getTotalQuantity() < 1 && !$customer_id) {
            $redirect = redirect()->route('site.index');

        } elseif($customer_id && \Cart::getTotalQuantity() > 0) {
            $redirect = redirect()->route('site.checkout.customer-shipping.info');

        } else {
            $redirect = view('site.checkout.register');
        }

        return $redirect;

    }

    /**
     * @param CustomerRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function processRegister(CustomerRegisterRequest $request)
    {
        $verify_code = random_int(10000, 90000);
        $customer_detail = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'verify_code' => $verify_code,
            'password' => bcrypt($request->password),
        ];

        $customer = Customer::create($customer_detail);

        Session::put('customer_id', $customer->id);

        $customer_info = [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'verify_code' => $customer->verify_code,
        ];

        Mail::to($customer->email)->send(new WelcomeCustomer($customer_info));
        getMessage('success', 'Your Account has been successfully created, please check your email and enter verification code to active your account.');
        return redirect()->route('site.customer.account.verify');


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutCustomerAccountVerify()
    {
        $customer_id = Session::get('customer_id');
        if($customer_id) {
            return view('site.customer.account-verify');
        } else {
            return redirect()->back();
        }



    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function processCheckoutCustomerAccountVerify(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'verify_code' => 'required',
        ]);

        $check_data = Customer::where('email', $request->email)->where('verify_code', $request->verify_code)->first();
        if ($check_data) {
            $check_data->status = 'active';
            $check_data->save();
            getMessage('success', 'Your are now verified your account.');
            return redirect()->route('site.checkout.customer-shipping');
        } else {
            getMessage('danger', 'Your Email or Verify Code does not matched, please enter valid informantion!');
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function processLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:25',
        ], [
            'email.required' => 'Email field must be filled out!',
            'password.required' => 'Password field must be filled out!',
            'password.min:6' => 'Mobile Number must be 6 Character\'s',
            'password.max:25' => 'Mobile Number must be less than 26 Character\'s',
        ]);

        $customer_detail = Customer::where('email', $request->email)->select('id', 'name', 'email', 'password')->first();
        if($customer_detail) {
            if(password_verify($request->password, $customer_detail->password)) {
                Session::put('customer_id', $customer_detail->id);
                Session::put('customer_name', $customer_detail->name);
                return redirect()->route('site.checkout.customer-shipping');

            } else {
                getMessage('danger', 'This Credential password is invalid!');
                return redirect()->back();
            }

        } else {
            getMessage('danger', 'This Credentials do not matched!');
            return redirect()->back();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutCustomerShipping()
    {
        $customer_id = Session::get('customer_id');
        if($customer_id) {
            $customer_info = Customer::find($customer_id)->select('id', 'name', 'email', 'phone')->first();
            return view('site.checkout.customer-shipping', compact('customer_info'));
        } else {
            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkoutCustomerShippingInfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' => 'required',
            'phone' => 'required|min:11|max:11',
            'address' => 'required|string',
        ]);

        $customer_info = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $shipping_info = Shipping::create($customer_info);
        Session::put('shipping_id', $shipping_info->id);

        return redirect()->route('site.checkout.customer-payment');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutCustomerPayment()
    {
        $customer_id = Session::get('customer_id');
        if($customer_id) {
            return view('site.checkout.customer-payment');

        } else {
            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutCustomerOrder(Request $request)
    {
        $customer_id = Session::get('customer_id');
//        dd($request->isMethod('POST'));
        if($request->isMethod('POST') && $customer_id) {
            $order_info = $this->insertOrder();
            $customer_detail = Customer::where('id', $order_info->customer_id)->first();
//        return $customer_detail;

            Payment::create([
                'order_id' => $order_info->id,
                'type' => $request->type,
            ]);

            $this->insertOrderItems($order_info->id);
            $order_item_details = OrderItem::where('order_id', $order_info->id)->get();
//        return $order_item_details;
            $cart_total_qty = \Cart::getTotalQuantity();
            $cart_total_price = \Cart::getTotal();

            \Cart::clear();

            Toastr::success('Your Order has been Submitted To Confirmed.', 'Success');
            return view('site.checkout.order-success', compact('customer_detail', 'order_item_details', 'cart_total_qty', 'cart_total_price'));

        } else {
            return redirect()->back();
        }



    }

    /**
     * @return mixed
     */
    private function insertOrder()
    {
        $order_info = Order::create([
            'customer_id' => Session::get('customer_id'),
            'shipping_id' => Session::get('shipping_id'),
            'total' => \Cart::getTotal(),

        ]);

        return $order_info;
    }

    /**
     * @param $order_id
     */
    private function insertOrderItems($order_id)
    {
        foreach (\Cart::getContent() as $item) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'product_price' => $item->price,
                'product_qty' => $item->quantity,
            ]);

        }

    }


}
