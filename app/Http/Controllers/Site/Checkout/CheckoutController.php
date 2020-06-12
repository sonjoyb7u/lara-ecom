<?php

namespace App\Http\Controllers\Site\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\Mail\WelcomeCustomer;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();

        View::share(['brands' => $brands]);
    }

    public function index()
    {
        return view('site.checkout.index');
    }

    public function customerRegister(CustomerRegisterRequest $request)
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
        getMessage('success', 'Your Account has been successfully created, please check your mail to confirm.');
        return redirect()->route('site.customer.account.verify');


    }

    public function customerAccountVerify()
    {
        return view('site.customer.account-verify');
    }

    public function checkAccountVerify(Request $request)
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

    public function checkoutCustomerShipping()
    {
        $customer_id = Session::get('customer_id');
        $customer_info = Customer::find($customer_id)->select('name', 'email', 'phone')->first();
        return view('site.checkout.customer-shipping', compact('customer_info'));
    }

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

    public function checkoutCustomerPayment() {
        return view('site.checkout.customer-payment');
    }


}
