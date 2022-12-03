<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function serveIndex() {
        return view('index', [ /*
                              'index' => $index, 
                              'publicBoards' => $publicBoards,
                              'randomQuote' => $randomQuote,
                              'news' => $news,
                              'hottestThreads' => $hottestThreads, */
                             ]
                   );

    }
}
