<?php

namespace App\Http\Controllers\Site\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\Mail\WelcomeCustomer;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerLogin() {
        $customer_id = Session::get('cuStOmArId');

        if(!$customer_id && \Cart::getTotalQuantity() < 1) {
            $redirect = redirect()->route('site.index');

        } elseif($customer_id && \Cart::getTotalQuantity() > 0) {
            $redirect = redirect()->route('site.checkout.customer-shipping.info');

        } elseif(!$customer_id && \Cart::getTotalQuantity() > 0) {
            $redirect = view('site.customer.login');

        }

        return $redirect;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerRegister() {
        return view('site.customer.register');
    }

    /**
     * @param CustomerRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function processRegister(CustomerRegisterRequest $request) {
        $verify_code = random_int(10000, 90000);
        if($request->isMethod('post')) {
            $customer_detail = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'verify_code' => $verify_code,
                'password' => bcrypt($request->password),
            ];
            $customer = Customer::create($customer_detail);
        }

        Session::put('cuStOmArId', $customer->id);
        Session::put('cuStOmArNaMe', $customer->name);

        $customer_info = [
            'name' => $customer->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'verify_code' => $customer->verify_code,
        ];

        Mail::to($customer->email)->send(new WelcomeCustomer($customer_info));
        getMessage('success', 'Your Account has been successfully created, please check your mail to enter verification code to active account.');
        return redirect()->route('site.customer.account.verify');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerAccountVerify()
    {
        return view('site.customer.account-verify');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function checkAccountVerify(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'verify_code' => 'required',
        ]);
        $customer_id = Session::get('cuStOmArId');

        $customer_data = Customer::where('email', $request->email)->where('verify_code', $request->verify_code)->first();
        $customer_data->status = 'active';

        if ($customer_data->save()) {
            if($customer_id && \Cart::getTotalQuantity() > 0) {
                getMessage('success', 'Your account has been succesfully created.');
                return redirect()->route('site.checkout.customer-shipping');

            } else {
                getMessage('success', 'Your account has been succesfully created.');
                return redirect()->route('site.index');
            }

        } else {
            getMessage('danger', 'Your Verify Code does not matched, please enter valid code!');
            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     */
    public function processLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:25',
        ], [
            'email.required' => 'Email field must be filled out!',
            'password.required' => 'Password field must be filled out!',
            'password.min:6' => 'Password Number must be 6 Character\'s',
            'password.max:25' => 'Password Number must be less than 26 Character\'s',
        ]);
        $customer_id = Session::get('cuStOmArId');

        $customer_detail = Customer::where('email', $request->email)->select('id', 'name', 'email', 'password')->first();
        if($customer_detail) {
            if(password_verify($request->password, $customer_detail->password)) {
                Session::put('cuStOmArId', $customer_detail->id);
                Session::put('cuStOmArNaMe', $customer_detail->name);

                if($customer_id && \Cart::getTotalQuantity() > 0) {
                    getMessage('success', 'Your are succesfully Logged In.');
                    return redirect()->route('site.checkout.customer-shipping');

                } else {
                    getMessage('success', 'Your are succesfully Logged In.');
                    return redirect()->route('site.index');
                }

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
     * @param $customer_id
     */
    public function customerAccount(Request $request, $customer_id)
    {
        if($request->isMethod('GET')) {
            $customer_id = base64_decode($customer_id);
            $customer = Customer::where('id', $customer_id)->first();

            return view('site.customer.my-account', compact('customer'));
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogout()
    {
        Session::forget('cuStOmArId');
        return redirect()->route('site.index');
    }



}
