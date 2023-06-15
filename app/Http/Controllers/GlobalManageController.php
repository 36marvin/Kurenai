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
        return view('services.manage.global.config')->with('configManager', $this->configManager);
    }

    // todo: make this view
    public function serveGlobalManagementDashboardPage () {
        return view('services.manage.global.dashboard');
    }

    public function setKurenaiGeneralConfig() {
        $isOpen = request('forumIsOpen');
        $isOpen = isset($isOpen) ? true : false;

        $this->configManager->setGeneralConfig(
            request('forumName'),
            request('forumDescription'),
            $isOpen,
            request('defaultTheme')
        );

        return redirect('/global/manage/config');
    }

    public function setKurenaiPostConfig(Request $request) {
        $mediaArray = $this->configManager->makeArrayOfAllowedMediaFromRequest();

        $this->configManager->setPostConfig(
            $request->minUserAgeForThreadCreation,
            $request->rateLimitForReplyCreation,
            $request->rateLimitForThreadCreation,
            $mediaArray
        );

        return redirect('/global/manage/config');
    }

    public function setKurenaiBoardConfig() {
        $allowCreation = request('allowUsersToCreateBoards');
        $allowCreation = isset($isOpen) ? true : false;

        $this->configManager->setBoardConfig(
            request('boardIndexMaxRepliesPerThread'),
            $allowCreation,
            request('rateLimitBoardCreation'),
            request('minUserAgeForCreatingBoard')
        );

        return redirect('/global/manage/config');
    }
}   
