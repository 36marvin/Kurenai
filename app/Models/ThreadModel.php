<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\PostModelParent;
use App\Models\ReplyModel;
use Database\Factories\ThreadFactory;

class ThreadModel extends PostModelParent
{
    use HasFactory;

    protected $table = 'threads';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function newFactory() {
        return ThreadFactory::new();
    }

    function makeThread ($threadBody, $threadTitle, $isLocked, $isInfinite, $allowHtml, $userId) {
        $threadBody = $this->formatBody($threadBody);
    }

    function deleteThread ($threadID) {

    }

    function updateThread ($newBody, $newTitle, $threadId) {
        
    }

    /**
     *  Returns a Collection object for a query containing the
     *  non pinned threads of a board. No query building is done yet.
     */

    private function getLatestNonPinnedThreads($boardUri) { 
        return $this->where('board_uri', $boardUri)
                    ->where('is_pinned', false)
                    ->orderBy('created_at')
                    ->get();
    }

    /**
     *  Returns a Collection object for a query containing the pinned
     *  threads of a given board. No query building is done yet.
     */

    private function getPinnedThreadsBoardIndex($boardUri) { 
        return $this->where('board_uri', $boardUri)
                    ->where('is_pinned', true)
                    ->orderBy('last_pinned_updated')
                    ->get();
    }

    /**
     *  Returns a Collection object of all threads with the pinned threads
     *  coming first. 
     */
    private function getAllThreadsBoardIndex() {
        $boardUri = request()->route()->parameter('boardUri');
        $howManyThreadsPerPage = config('kurenai.global.boardConfig.boardIndexMaxRepliesPerThread', 10);
        $pinnedThreads = $this->getPinnedThreadsBoardIndex($boardUri);
        $nonPinnedThreads = $this->getLatestNonPinnedThreads($boardUri);
        $allThreads = $pinnedThreads->concat($nonPinnedThreads);

        // Turning this from a Collection into a query builder againt because we 
        // need to paginate all pinned and non pinned threads together
        if($allThreads->isNotEmpty()) {
            $allThreads= $allThreads->toQuery()
                                    ->leftJoin('users', 'users.id', '=', 'threads.user_id')
                                    ->select('threads.id', 'users.name as poster', 'threads.title', 'threads.created_at', 'threads.is_locked', 'threads.is_infinite', 'threads.is_pinned')
                                    ->paginate($howManyThreadsPerPage)
                                    ->toArray();
        } else {
            $allThreads = $allThreads->toArray();
        }
        return $allThreads;
    }

    private function appendRepliesToThreads (array $threads) {
        if (!$threads) {
            return;
        };

        $howManyRepliesPerThread = isset($globalConfig) ? $globalconfig::select('replies_per_thread')->first()->threads_per_page : 5;
        foreach($threads['data'] as $thread) {
            $thread += ['replies' => array()];
            $replies = DB::table('replies')
                         ->leftJoin('users', 'replies.user_id', '=', 'users.id')
                         ->select('replies.reply_title', 'users.name as poster', 'replies.thread_id')
                         ->where('replies.reply_title', '!=', null)
                         ->where('replies.thread_id', '=', $thread['id'])
                         ->limit($howManyRepliesPerThread)
                         ->get()
                         ->toArray();
            $thread['replies'] = $replies;
        };
        return $threads;
    }

    public function getPaginatedBoardIndexThreadsWithReplies() {
        $threads = $this->getAllThreadsBoardIndex();
        $threads = $this->appendRepliesToThreads($threads);
        return $threads;
    }
}
