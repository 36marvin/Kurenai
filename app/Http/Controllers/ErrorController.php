<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __construct () {
        $this->errorList = [
        '404' => // page not found
                [
                'header' => '404 NOT FOUND',
                'description' => 'You tried so hard, and got so far. In
                                  the end, your resource wasn\'t even 
                                  found'
                ],
        '403' => // forbidden
                [
                'header' => '403 NOT ENOUGH PERMISSIONS',
                'description' => 'Either you are not logged in at all, 
                                  or your account just does not have 
                                  permissions to do that.'
                ],
        '500' => // unknown/unspecified error. Sometimes we don't want the end-user to know exactly what went wrong (that could be helpful to hackers)
                [
                'header' => '500 INTERNAL SERVER ERROR',
                'description' => 'Something didn\'t go well and because 
                                  of that you won\'t be getting what you 
                                  wanted.'
                ]
        ];
    }

    public function serveErrorPage() {
        $errorName = request()->route()->parameter('errorName');
        switch ($errorName) {
            case '404':
                return view('error.default-template')->with('errorMessage', $this->errorList['404']);
            case '403':
                return view('error.default-template')->with('errorMessage', $this->errorList['403']);
            case '500':
                return view('error.default-template')->with('errorMessage', $this->errorList['500']);
            default: // this happens when the user goes on example.com/error/anyNonExistingError
                return redirect('/error/404');
        };
    }

    public function customError($header, $description) {
        $errorMessage = [
            'header' => $header,
            'description' => $description
        ];
        return view('error.default-template')->with($errorMessage);
    }
}
