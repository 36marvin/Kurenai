<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

/**
 *  Just for psychological/clarity purposes. Google up 
 *  "programming to the interface" and you'll see what 
 *  I'm doing
 */

interface Iboard 
{
    public function deleteBoard($uri): void;
    public function createBoard($options): void;
    public function updateBoardConfig($uri, $options): void;
    public function serveBoard($uri, $page): View;
}

class BoardController extends Controller implements Iboard
{
    function serveBoard ($boardUri, $page) { // this is not going to last, we need a view composer
        $boardData = $this->getBoardPageData($boardUri, $page);
        return view('board-index', $boardData);
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


    /**
     *   Returns an array containing thread data (title, author, time...), 
     *   and reply data (title, author, etc) for each thread.
     */

    private function getBoardViewData($boardUri, $page, BoardModel $board) {
        if (!$page) {
            $page = 1;
        }

        $board->getBoardViewData();

        return $thread;
    }
}
