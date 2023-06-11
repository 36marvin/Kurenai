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

    // todo: make this view
    public function serveGlobalManagementDashboardPage () {
        return view('services.manage.global.dashboard');
    }

    public function setKurenaiGeneralConfig(Request $request) {
        $this->configManager->setGeneralConfig(
            $request->forumName,
            $request->forumDescription,
            $request->forumIsOpen,
            $request->defaultTheme
        );
    }

    public function setKurenaiPostConfig(Request $request) {
        $mediaArray = $this->configManager->makeArrayOfAllowedMediaFromRequest();

        $this->configManager->setPostConfig(
            $request->minUserAgeForThreadCreation,
            $request->rateLimitForReplyCreation,
            $request->rateLimitForThreadCreation,
            $mediaArray
        );
    }

    public function setKurenaiBoardConfig(Request $request) {
        $this->configManager->setBoardConfig(
            $request->boardIndexMaxRepliesPerThread,
            $request->allowUsersToCreateBoards,
            $request->rateLimitBoardCreation,
            $request->minUserAgeForCreatingBoard
        );
    }
}   
