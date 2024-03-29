<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\BoardModel;
use App\Services\ConfigManagerService;

/**
 *  Let's program to the interface.
 * 
 *  Remember to validate the requests somewhere else, 
 *  otherwise weird bugs will occur.
 */

interface Iboard 
{
    public function deleteBoard($uri): bool; 
    public function createBoard($options): bool;
    public function updateBoardConfig($uri, $options): bool;
    public function serveBoard(): View;
}

class BoardController extends Controller // implements Iboard
{
    public function __construct(BoardModel $boardModel) {
        $this->boardModel = $boardModel;
    }

    public function serveBoard () // this is not going to last, we need a view composer
    {
        $threads = $this->boardModel->getThreadsForIndex();
        $boardConfig = $this->boardModel->getBoardConfig();

        return view('board-index')->with('threads', $threads)
                                  ->with('boardConfig', $boardConfig);
    }

    public function serveCreateBoardPage(ConfigManagerService $globalConfig)
    {
        return view('services.create-board')->with('configManager', $globalConfig);
    }

    public function serveBoardListPage()
    {
        $boardList = $this->boardModel->getAllBoardsPaginated();
        $boardCounts = $this->boardModel->getBoardCounts();
        return view('services.board-list')->with('boardList', $boardList)
                                          ->with('boardCounts', $boardCounts);
    }

    public function serveLocalBoardManagementPageDangerZone () {
        $boardConfig = $this->boardModel->getBoardConfig();
        return view('services.manage.local.delete-freeze-board')->with('boardConfig', $boardConfig);
    }

    public function serveLocalBoardManagementPage () {
        $boardConfig = $this->boardModel->getBoardConfig();
        return view('services.manage.local.index-management')->with('boardConfig',$boardConfig);
    }

    /**
     *  Where options are the name of the board, it's
     *  visibility config, description, uri, etc..
     */

    public function createBoard () {
        $this->boardModel->createBoard(
            request('name'),
            request('uri'),
            request('description'),
            request('isFrozen') === 'true' ? true : false,
            request('isSecret') === 'true' ? true : false,
            request('isGlobalStaffOnly') === 'true' ? true : false,
        );
        
        return redirect('/');
    }

    public function deleteBoard ($uri) {
        $this->boardModel->deleteBoard($uri);
    }

    public function updateBoardConfig ($options) {
        $this->boardModel->setBoardConfig($options);
    }

    private function setBoardConfig () {

    }
}
