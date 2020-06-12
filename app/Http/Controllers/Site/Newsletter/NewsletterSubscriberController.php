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
    public function create()
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
        if($request->ajax()) {
            $email = $request->email;
            $check_email = [];
            $check_email[] = NewsletterSubscriber::where('email', $email)
                                                ->where('status', NewsletterSubscriber::STATUS_ACTIVE)->first();
            if(count($check_email) > 0) {
                return 'Sorry! You have already been subscribed!';

            } else {
                return 'Thanks For Subscribe With Us.';

            }


        }

//        if ( ! Newsletter::isSubscribed($request->email) )
//        {
//            Newsletter::subscribePending($request->email);
//            Toastr::success('Thanks For Subscribe With Us.', 'Success');
//            return redirect()->back();
//        }
//
//        Toastr::error('Sorry! You have already subscribed!', 'Error');
        return redirect()->back();

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
