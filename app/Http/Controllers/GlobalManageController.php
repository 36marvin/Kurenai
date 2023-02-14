<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConfigManagerService;

class GlobalManageController extends Controller
{
    private $configManager;

    public function __construct () {
        $this->configManager = new ConfigManagerService;
    }
    public function serveGlobalManagementConfigPage () {
        return view('services.manage.global.config');
    }

    public function setKurenaiGeneralConfig() {

    }

    public function setKurenaiPostConfig() {

    }

    public function setKurenaiBoardConfig() {

    }
}   
