<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

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

    private function getBoardConfig($boardUri, $page, Request $request, BoardModel $board) {
        $boardConfig = $board::select('uri', 'name', 'description')
                             ->where('board_uri', $boardUri)
                             ->get();
        return $boardConfig;
    }

    private function getThreads($boardUri, ThreadModel $thread, GlobalConfigModel $globalConfig, BoardModel $board) {
        // get the number of threads to display per page
        $threadsPerPage = $globalConfig::select('threads_per_page')->first()->threads_per_page; 

        // the paginator will wrap all threads into a x 
        // number of pages each containing that number of threads
        $threads = DB::table('threads')
                     ->select(raw(
                                  "SELECT id, title, body, created_at, is_locked, is_infinite, is_pinned FROM threads WHERE thread_uri = $threadUri AND is_pinned = true ORDER BY last_pinned_updated
                                  UNION
                                  SELECT id, title, body, created_at, is_locked, is_infinite, is_pinned FROM threads WHERE thread_uri = $threadUri AND is_pinned = false ORDER BY last_valid_bump_at"
                                 )
                             )
                     ->paginate($threadsPerPage)
                     ->get();

        // now append the replies to the threads under the replies property
        
        // check what threads we do have, so we can make a single query to get all replies later
        $whatThreadsDoWeHave;
        foreach($threads as $thread) {
            $whatThreadsDoWeHave = appendArray($thread->id); //append to the end of the array
        };
        
        // return $threads;
    }
}
