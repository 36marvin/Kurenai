<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Http\Controllers\ErrorController;

class User extends Controller
{
    public function serveSignUpPage()
    {
        return view('services.signup');
    }

    public function serveloginPage()
    {
        return view('services.login');
    }

    public function signUp(UserModel $userModel, Request $request)
    {
        $userModel->signUp($request);
    }

    public function login(UserModel $userModel, Request $request, ErrorController $errorController)
    {
        $userModel->login($request, $errorController);
    }

    public function logOut(UserModel $userModel, Request $request)
    {
        $userModel->logOut($request);
    }
}
