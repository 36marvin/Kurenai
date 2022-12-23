<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostModelParent;
use App\Models\ReplyModel;

class ThreadModel extends PostModelParent
{
    use HasFactory;

    protected $table = 'threads';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

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
                    ->orderBy('created_at');
    }

    /**
     *  Returns a Collection object for a query containing the pinned
     *  threads of a given board. No query building is done yet.
     */

    private function getPinnedThreadsBoardIndex($boardUri) { 
        return $this->where('board_uri', $boardUri)
                    ->where('is_pinned', true)
                    ->orderBy('last_pinned_updated');
    }

    /**
     *  Returns a Collection object of all threads with the pinned threads
     *  coming first. 
     */

    private function getAllThreadsBoardIndex(Request $request) {
        $boardUri = $request->boardUri;
        $howManyThreadsPerPage = $globalConfig::select('threads_per_page')->first()->threads_per_page;
        $pinnedThreads = $this->getPinnedThreads($boardUri);
        $nonPinnedThreads = $this->getLatestNonPinnedThreads($boardUri);
        $allThreads = $pinnedThreads->concat($nonPinnedThreads);

        // The "Collection" part is complete, now let's build the query
        $allThreads= $allThreads->leftJoin('users', 'users.id', '=', 'threads.user_id')
                                ->select('threads.id', 'users.name as poster', 'threads.title', 'threads.created_at', 'threads.is_locked', 'threads.is_infinite', 'threads.is_pinned')
                                ->paginate($howManyThreadsPerPage)
                                ->distinct()
                                ->get()
                                ->toArray();
        return $allThreads;
    }

    private function appendRepliesToThreads (array $threads): array {
        $howManyRepliesPerThread = $globalConfig::select('replies_per_thread')->first()->threads_per_page;
        foreach($threads as $thread) {
            $thread += ['replies' => array()];
            $replies = DB::table('replies')
                         ->leftJoin('users', 'replies.user_id', '=', 'users.id')
                         ->select('replies.title', 'user.name as poster', 'replies.thread_id')
                         ->where('replies.title', '!=', null)
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
