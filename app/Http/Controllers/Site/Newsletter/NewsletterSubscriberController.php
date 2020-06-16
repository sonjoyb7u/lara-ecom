<?php

namespace App\Http\Controllers\Site\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Newsletter;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     * @return string
     */
    public function checkSubscriber(Request $request) {
        if($request->ajax()) {
            $email = $request->email;
            $check_email = NewsletterSubscriber::where('email', $email)
                ->where('status', NewsletterSubscriber::STATUS_ACTIVE)->count();
            if($check_email > 0) {
                Toastr::error('Sorry! This email already been subscribed!', 'Exists');
                return 'exists';

            }


        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function addSubscriber(Request $request) {
        if($request->ajax()) {
            $email = $request->email;
            $check_email = NewsletterSubscriber::where('email', $email)
                ->where('status', NewsletterSubscriber::STATUS_ACTIVE)->count();
            if($check_email > 0) {
                Toastr::error('Sorry! This email already been subscribed!', 'Exists');
                return 'exists';

            } else {
                $new_email = [
                    'email' => $email,
                    'status' => 0,
                ];
                $add_email = NewsletterSubscriber::create($new_email);
                if($add_email) {
                    Toastr::error('Wow, Thanks for subscribed.', 'Success');
                    echo 'saved';
                }
            }


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
