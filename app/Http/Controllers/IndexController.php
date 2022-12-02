<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function serveIndex() {
        $index = [
            'siteName' => 'retroboard',
            'siteDescription' => 'aaaa',
        ];
        $publicBoards; // to define
        $randomQuote; // maybe cache this as an array with all the quotes?

        return view('index', [
                              'index' => $index, 
                              'publicBoards' => $publicBoards,
                              'randomQuote' => $randomQuote,
                              'news' => $news,
                              'hottestThreads' => $hottestThreads,
                             ]
                   );

    }
}
