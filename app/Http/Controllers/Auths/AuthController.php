<?php

namespace App\Http\Controllers\Auths;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('admin.components.login');
    }

    public function showRegisterForm() {
        return view('admin.components.register');
    }
}
