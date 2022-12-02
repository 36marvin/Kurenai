<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function serveIndex() {
        return view('index', [
                              'index' => $index ?? null, 
                              'publicBoards' => $publicBoards ?? null,
                              'randomQuote' => $randomQuote ?? null,
                              'news' => $news ?? null,
                              'hottestThreads' => $hottestThreads ?? null,
                             ]
                   );

    }
}
