<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardModel;

class IndexController extends Controller
{
    function serveIndex(BoardModel $boardModel) {
        $boards = $boardModel->getAllBoards();
        return view('index')->with('boards', $boards);
    }
}
