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
     * CustomerController constructor.
     */
    public function __construct()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();

        View::share(['brands' => $brands]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customerLogin() {
        return view('site.customer.login');
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
        if($request->isMethod('post')) {
            $verify_code = random_int(10000, 90000);
            $customer_detail = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'verify_code' => $verify_code,
                'password' => bcrypt($request->password),
            ];
            $customer = Customer::create($customer_detail);
        }

        Session::put('customer_id', $customer->id);
        Session::put('customer_name', $customer->name);

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

        $check_data = Customer::where('email', $request->email)->where('verify_code', $request->verify_code)->first();
        if ($check_data) {
            $check_data->status = 'active';
            $check_data->save();
            getMessage('success', 'Your account has been succesfully created.');
            return redirect()->route('site.index');

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

        $customer_detail = Customer::where('email', $request->email)->select('id', 'name', 'email', 'password')->first();
        if($customer_detail) {
            if(password_verify($request->password, $customer_detail->password)) {
                Session::put('customer_id', $customer_detail->id);
                Session::put('customer_name', $customer_detail->name);
                return redirect()->route('site.index');

            } else {
                getMessage('danger', 'This Credential password is invalid!');
                return redirect()->back();
            }

        } else {
            getMessage('danger', 'This Credentials do not matched!');
            return redirect()->back();
        }
    }

    public function processLogout() {
        Session::forget('customer_id');
        return redirect()->route('site.index');
    }



}
