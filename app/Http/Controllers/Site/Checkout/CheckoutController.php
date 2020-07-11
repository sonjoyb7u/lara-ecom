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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkoutLogin()
    {
        $customer_id = Session::get('cuStOmArId');
        $customer_info = Customer::findorFail($customer_id);
        if($customer_id > 0 && \Cart::getTotalQuantity() > 0) {
            $redirect = view('site.checkout.customer-shipping', compact('customer_info'));
        } elseif(empty($customer_id)) {
            getMessage('danger', 'Please Login Or Register To Your Account!');
            $redirect = redirect()->back();
        } elseif(empty(\Cart::getTotalQuantity())) {
            getMessage('danger', 'Please Add Product Into Your Cart List!');
            $redirect = redirect()->back();
        } else {
            $redirect = view('site.customer.login');
        }

        return $redirect;
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
            'password.min:6' => 'Password length must be 6 Character\'s',
            'password.max:25' => 'Password length must be less than 26 Character\'s',
        ]);

        $customer_info = Customer::where('email', $request->email)->select('id', 'name', 'email', 'phone', 'password')->first();
        if($customer_info) {
            if(password_verify($request->password, $customer_info->password)) {
                Session::put('cuStOmArId', $customer_info->id);
                Session::put('cuStOmArNaMe', $customer_info->name);
//                Session::put('cuStOmArEmAiL', $customer_detail->email);
//                Session::put('cuStOmArPhOnE', $customer_detail->phone);

                $redirect = redirect()->route('site.checkout.customer-shipping', compact('customer_info'));

            } else {
                getMessage('danger', 'This Credential password is invalid!');
                $redirect = redirect()->back();
            }

        } else {
            getMessage('danger', 'This Credentials do not matched!');
            $redirect = redirect()->back();
        }

        return $redirect;
    }

    /**
     * CHECKOUT REGISTER FORM LOAD...
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutRegister()
    {
        $customer_id = Session::get('cuStOmArId');
        $customer_info = Customer::findorFail($customer_id);
        if(empty(\Cart::getTotalQuantity())) {
            getMessage('danger', 'Please Add Product To Your Cart List!');
            $redirect = redirect()->back();
        } elseif($customer_id > 0 && \Cart::getTotalQuantity() > 0) {
            $redirect = view('site.checkout.customer-shipping', compact('customer_info'));
        } else {
            $redirect = view('site.customer.register');
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

        Session::put('cuStOmArId', $customer->id);
        Session::put('cuStOmArNaMe', $customer->name);
        Session::put('cuStOmArEmAiL', $customer_detail->email);
        Session::put('cuStOmArPhOnE', $customer_detail->phone);

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
//    public function checkoutCustomerAccountVerify()
//    {
//        $customer_id = Session::get('cuStOmArId');
//        if($customer_id) {
//            return view('site.customer.account-verify');
//        } else {
//            return redirect()->back();
//        }
//
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
//    public function processCheckoutCustomerAccountVerify(Request $request)
//    {
//        $this->validate($request, [
//            'email' => 'required',
//            'verify_code' => 'required',
//        ]);
//        $customer_id = Session::get('cuStOmArId');
//        $checkout_data = Customer::where('email', $request->email)->where('verify_code', $request->verify_code)->first();
//        $checkout_data->status = 'active';
//        if ($checkout_data->save()) {
//            if($customer_id && \Cart::getTotalQuantity() > 0) {
//                getMessage('success', 'Your account has been succesfully created.');
//                return redirect()->route('site.checkout.customer-shipping');
//
//            } else {
//                getMessage('success', 'Your account has been succesfully created.');
//                return redirect()->route('site.index');
//            }
//
//
//        } else {
//            getMessage('danger', 'Your Email or Verify Code does not matched, please enter valid informantion!');
//            return redirect()->back();
//        }
//    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkoutCustomerShipping(Request $request)
    {
        if($request->isMethod('GET')) {
            $customer_id = Session::get('cuStOmArId');
            $customer_info = Customer::where('id', $customer_id)->select('name', 'email', 'phone', 'address')->first();
//            return $customer_info;
            return view('site.checkout.customer-shipping', compact('customer_info'));

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
        $customer_id = Session::get('cuStOmArId');
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
        $customer_id = Session::get('cuStOmArId');
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
            'customer_id' => Session::get('cuStOmArId'),
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogout()
    {
//        $customer_id = Session::get('cuStOmArId');
//        \Cart::session($customer_id)->clear();

        Session::forget('cuStOmArId');
        getMessage('success', 'You Are Successfully Logged Out.');
        return redirect()->route('site.cart.show');


    }


}
