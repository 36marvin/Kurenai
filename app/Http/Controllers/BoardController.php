<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\BoardModel;
use App\Models\GlobalConfigModel;

/**
 *  Let's program to the interface.
 * 
 *  Remember to validate the requests somewhere else, 
 *  otherwise weird bugs will occur.
 */

interface Iboard 
{
    public function deleteBoard($uri): bool; // did it work?
    public function createBoard($options): bool;
    public function updateBoardConfig($uri, $options): bool;
    public function serveBoard($boardUri): View;
}

class BoardController extends Controller implements Iboard
{
    function serveBoard (BoardModel $boardModel) { // this is not going to last, we need a view composer
        $threads = $boardModel->getThreadsForIndex();
        $boardConfig = $boardModel->getBoardConfig();
        return view('board-index', $threads, $boardConfig);
    }

    /**
     *  Where options are the name of the board, it's
     *  visibility config, description, uri, etc..
     */

    public function createBoard (BoardModel $boardModel) {
        $boardModel->createBoard();
    }

    public function deleteBoard ($boardUri) {
        
    }

    public function updateBoardConfig ($options) {
        $this->setBoardConfig($options);
    }

    private function setBoardConfig () {

    }
}
