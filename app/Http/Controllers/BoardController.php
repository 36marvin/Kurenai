<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Model\BoardModel;
use App\Model\GlobalConfigModel;

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
    function serveBoard ($boardUri, BoardModel $boardModel) { // this is not going to last, we need a view composer
        $threads = $boardModel->getThreads($boardUri);
        $boardConfig = $boardModel->getBoardConfig($boardUri);
        return view('board-index', $threads, $boardConfig);
    }

    /**
     *  Where options are the name of the board, it's
     *  visibility config, description, uri, etc..
     */

    public function createBoard ($options) {
        // create table

        $this->setBoardInfo($options);
    }

    public function deleteBoard ($boardUri) {
        
    }

    public function updateBoardConfig ($options) {
        $this->setBoardConfig($options);
    }

    private function setBoardConfig () {

    }
}
