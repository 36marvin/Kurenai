<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function serveSignUpPage () {
        return view('services.signup');
    }

    public function serveloginPage () {
        return view('services.login');
    }
}
