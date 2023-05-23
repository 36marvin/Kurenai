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

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    protected static function newFactory() {
        return ThreadFactory::new();
    }

    function newThread (Request $request) {
        $self->create([
            'body' => $request->threadBody,
            'title' => $request->threadTitle,
            'boardUri' => $request->boardUri,
            
            'embeddedLink' => $request->embeddedLink ?? null,
            'embeddedLinkTitle' => $request->embeddedLinkTitle ?? null,
            
            'isLocked' => $request->isLocked ?? false,
            'isInfinite' => $request->isInfinite ?? false,
            'allowHtml' => $request->allowHtml ?? false,
            'userId' => Auth::id(),
        ]);
    }
    /**
     *  For the thread index.
     */
    public function getThreadPostAndUser($threadPseudoId)
    {
        $post = DB::table('threads')->where('inBoardPseudoId', $threadPseudoId)
                                    ->first();
        $user = DB::table('users')->where('id', $post->userId)
                                  ->first();

        $obj = new \stdClass;
        $obj->post = $post;
        $obj->user = $user;

        return $obj;
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
        return $this->where('boardUri', $boardUri)
                    ->where('isPinned', false)
                    ->orderBy('createdAt')
                    ->get();
    }

    /**
     *  Returns a Collection object for a query containing the pinned
     *  threads of a given board. No query building is done yet.
     */

    private function getPinnedThreadsBoardIndex($boardUri) { 
        return $this->where('boardUri', $boardUri)
                    ->where('isPinned', true)
                    ->orderBy('lastPinnedUpdated')
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
                                    ->leftJoin('users', 'users.id', '=', 'threads.userId')
                                    ->select('threads.id', 'users.name as poster', 'threads.title', 'threads.createdAt', 'threads.isLocked', 'threads.isInfinite', 'threads.isPinned', 'threads.isCensored', 'threads.boardUri', 'threads.inBoardPseudoId')
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
                         ->leftJoin('users', 'replies.userId', '=', 'users.id')
                         ->select('replies.title', 'users.name as poster', 'replies.threadId')
                         ->where('replies.title', '!=', null)
                         ->where('replies.threadId', '=', $thread['id'])
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

    public function getThreadPseudoIdByUri($uri)
    {
        return DB::table('threads')->select('pseudoId')
                                   ->where('uri', $uri)
                                   ->first();
    }

    // Threads in different boards may have the same
    // pseudo id, so the user of this functioon will 
    // have to tell us what board the thread is in. 
    public function getThreadIdByPseudoId($threadPseudoId, $boardUri)
    {
        return DB::table('threads')->select('id')
                                   ->where('inBoardPseudoId', $threadPseudoId)
                                   ->where('boardUri', $boardUri)
                                   ->first();
    }
}
