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
                    /**
                     * this query should put all pinned threads at the top, sorted by the 
                     * last_pinned update timestamp;
                     * then at the bottom comes all the non-pinned threads sorted by the 
                     * last_valid_bump timestamp and, if none, the created_at timestamp.   
                     */
                     ->select(raw( 
                                  "SELECT thread.id, title, user.name, body, created_at, is_locked, is_infinite, is_pinned FROM threads WHERE board_uri = $boardUri AND is_pinned = true
                                  LEFT JOIN users ON threads.user_id = user.id
                                  UNION
                                  SELECT thread.id, title, user.name, body, created_at, is_locked, is_infinite, is_pinned FROM threads WHERE thread_uri = $threadUri AND is_pinned = false
                                  LEFT JOIN users ON threads.user_id = user.id
                                  ORDER BY is_pinned, last_pinned_update, last_valid_bump_at, created_at DESC"  
                                 )
                             )
                     ->paginate($threadsPerPage)
                     ->get();

        // now append the replies to the threads under the replies property
        
        // make a list of what threads we do have
        $whatThreadsDoWeHave = [];
        foreach($threads as $thread) {
            arrayPush($whatThreadsDoWeHave, $thread->id); //append to the end of the array
        };

        // we will use a single query to fetch those replies that 
        // match with the id of any thread that we have in the list
        $threadIdsForQuery = strval($whatThreadsDoWeHave);

        // now we make the query
        $replies = DB::table('replies')
                     ->select(raw(
                                  "SELECT title, user.name FROM replies WHERE board_uri = $boardUri AND title != null AND thread_id IN &{$threadIdsArray}"
                            ));

        // return $threads;
    }
}
