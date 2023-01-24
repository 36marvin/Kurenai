<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalManageController extends Controller
{
    public function serveGlobalManagementConfigPage () {
        return view('services.manage.global.config');
    }
}
