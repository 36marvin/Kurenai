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
    function serveBoard ($boardUri) { // this is not going to last, we need a view composer
        $threads = $this->getThreads($boardUri);
        $boardConfig = setBoardConfig($boardUri);
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


    /**
     *   Returns an array containing thread data (title, author, time...), 
     *   and reply data (title, author, etc) for each thread.
     */

    private function getBoardConfig($boardUri, Request $request, BoardModel $board): array {
        $boardConfig = $board::select('uri', 'name', 'description')
                             ->where('board_uri', $boardUri)
                             ->get()
                             ->toArray();
        return $boardConfig;
    }

    private function getThreads($boardUri) {
        $threads = getThreadsAtPage($boardUri);
        $threads = appendRepliesToThreads($threads);
        return $threads;
    }

    private function getThreadsAtPage ($boardUri, GlobalConfigModel $globalConfig) {
        $threadsPerPage = $globalConfig::select('threads_per_page')->first()->threads_per_page; 

        // get all threads of the current page according to the aforementioned pagination constraint
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
                     ->get()
                     ->toArray();
        return $threads;
    }

    private function appendRepliesToThreads (array $threads): array {
        $threadsWithReplies;
        foreach($threads as $thread) {
            $thread += ['replies' => array()];
            $replies = DB::table('replies')
                         ->select(raw(
                                      "SELECT title, user.name, thread_id as id FROM replies
                                      WHERE title !=null AND thread_id = ${$thread['id']}
                                      LEFT JOIN users ON replies.user_id = user.id
                                      ORDER BY created_at LIMIT 6;"
                                     )
                                 )
                         ->get()
                         ->toArray();
            $thread['replies'] = $replies;
        };
        return $threads;


        // WELP... I TRIED
        //
        // we will use a single query to fetch those replies that 
        // match their thread_id property with the id of any thread 
        // that we have in the list
        // $threadIdsForQuery = strval($whatThreadsDoWeHave);
        // $replies = DB::table('replies')
        //              ->select(raw(
        //                           "SELECT title, user.name, thread_id as id FROM replies 
        //                           WHERE board_uri = $boardUri AND title != null AND thread_id IN &{$threadIdsArray}"
        //                          )
        //                      )
        //              ->get();
        // $replies = json_decode(json_encode($replies), true);        
        // return $replies;
    }

    // private function appendRepliesToThreads (array $threads, array $replies) {
    //     foreach ($threads as $thread) {
    //         $thread += ['replies' => array()];
    //         foreach ($replies as $reply) {
    //             if ($reply['thread_id'] == $thread['id']) {
    //                 $thread['replies'] += $reply;
    //             }
    //         }
    //     };
    // }
}
