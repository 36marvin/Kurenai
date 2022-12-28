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

    public function serveBoard () { // this is not going to last, we need a view composer
        $threads = $this->boardModel->getThreadsForIndex();
        $boardConfig = $this->boardModel->getBoardConfig();
        return view('board-index', $threads, $boardConfig);
    }

    /**
     *  Where options are the name of the board, it's
     *  visibility config, description, uri, etc..
     */

    public function createBoard () {
        $this->boardModel->createBoard();
    }

    public function deleteBoard ($boardUri) {
        
    }

    public function updateBoardConfig ($options) {
        $this->boardModel->setBoardConfig($options);
    }

    private function setBoardConfig () {

    }
}
