<?php

namespace App\Http\Controllers\Admin\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::latest()->get();

        return view('admin.contact-us.index', compact('contacts'));
    }
}
