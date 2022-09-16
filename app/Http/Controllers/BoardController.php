<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    function serveBoard ($boardUri, $page) { // this is not going to last, we need a view composer
        $boardData = $this->getBoardPageData($boardUri, $page);
        return view('board-index', $boardData);
    }

    /**
     *  Where options are the name of the board, it's
     *  visibility config, description, uri, etc..
     */

    function createBoard ($options) {
        // create table

        $this->setBoardInfo($options);
    }

    function deleteBoard ($boardUri) {
        
    }

    function updateBoardConfig ($options) {
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
