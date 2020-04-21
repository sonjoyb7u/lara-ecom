<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.index');
    }

    public function admin()
    {
        return view('admin.admin');
    }

    // public function logout() {
    //     auth()->logout();

    //     return redirect()->route('login');

    // }



}
