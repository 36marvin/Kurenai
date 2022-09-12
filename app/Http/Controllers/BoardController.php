<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    function serveBoardIndex ($page, Request $request) {
        if (!$page) {
            $page = 1;
        }
    }

    function createBoard (Request $request, BoardModel $board) {
        // create table
        $this->setBoardInfo(); // insert name, description, options, etc.
    }

    function deleteBoard ($request, BoardModel $board) {
        
    }

    function updateBoard (Request $request) {
        $this->setBoardInfo();
    }

    private function setBoardInfo () {

    }
}
