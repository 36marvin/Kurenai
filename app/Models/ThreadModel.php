<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\PostModelParent;
use App\Models\ReplyModel;
use App\Models\BoardModel;
use Database\Factories\ThreadFactory;

class ThreadModel extends PostModelParent
{
    use HasFactory;

    protected $table = 'threads';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'body',
        'boardUri',
        'inBoardPseudoId',
        'userId',
        'isLocked',
        'isInfinite',
        'isPinned',
        'isCensored',
    ];

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    protected static function newFactory() {
        return ThreadFactory::new();
    }

    function newThread ($title, $body, $boardUri, $userId, array $boardConfig) 
    {
        $postCountCurrent = App::make(BoardModel::class)->getPostCount($boardUri);

        $this->create([
            'title' => $title ? $title : 'Untitled thread',
            'body' => $body,
            'boardUri' => $boardUri,
            'inBoardPseudoId' => $postCountCurrent == false ? 1 : $postCountCurrent + 1,
            'userId' => $userId,

            'isLocked' => $boardConfig['isLocked'],
            'isInfinite' => $boardConfig['isInfinite'],
            'isPinned' => $boardConfig['isPinned'],
            'isCensored' => $boardConfig['isCensored'],
        ]);

        App::make(BoardModel::class)->incrementBoardPostCount($boardUri);
    }
    /**
     *  For the thread index.
     */
    public function getThreadPostAndUser($threadPseudoId, $boardUri)
    {
        $post = DB::table('threads')->where('inBoardPseudoId', $threadPseudoId)
                                    ->where('boardUri', $boardUri)
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
                    ->orderBy('createdAt')
                    ->get();
    }

    /**
     *  Returns a Collection object of all threads with the pinned threads
     *  coming first. 
     */
    private function getAllThreadsBoardIndex() {
        $boardUri = request()->route()->parameter('boardUri');
        $howManyThreadsPerPage = config('kurenai.global.boardConfig.boardIndexMaxRepliesPerThread', 20);
        $pinnedThreads = $this->getPinnedThreadsBoardIndex($boardUri);
        $nonPinnedThreads = $this->getLatestNonPinnedThreads($boardUri);
        $allThreads = $pinnedThreads->concat($nonPinnedThreads);

        // Turning this from a Collection into a query builder againt because we 
        // need to paginate all pinned and non pinned threads together
        if($allThreads->isNotEmpty()) {
            $allThreads= $allThreads->toQuery()
                                    ->leftJoin('users', 'users.id', '=', 'threads.userId')
                                    ->select('threads.id', 'users.name as poster', 'threads.title', 'threads.createdAt', 'threads.isLocked', 'threads.isInfinite', 'threads.isPinned', 'threads.isCensored', 'threads.boardUri', 'threads.inBoardPseudoId')
                                    ->orderByRaw('isPinned DESC, createdAt DESC')
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
        foreach($threads['data'] as $index => $thread) {
            $replies = DB::table('replies')
                         ->leftJoin('users', 'replies.userId', '=', 'users.id')
                         ->select('replies.title', 'users.name as poster', 'replies.threadId')
                         ->where('replies.title', '!=', null)
                         ->where('replies.threadId', '=', $thread['id'])
                         ->orderBy('createdAt', 'desc') // get the
                         ->limit($howManyRepliesPerThread) // latest replies
                         ->get()
                         ->reverse() // now revert their order (put the earliest replies at the END of collection) 
                         ->toArray();
            $threads['data'][$index]['replies'] = $replies;
        };
        return $threads;
    }

    public function getPaginatedBoardIndexThreadsWithReplies() {
        $threads = $this->getAllThreadsBoardIndex();
        $threads = $this->appendRepliesToThreads($threads);
        return $threads;
    }

    // Threads in different boards may have the same
    // pseudo id, so the user of this functioon will 
    // have to tell us what board the thread is in. 
    public function getThreadIdByPseudoId($threadPseudoId, $boardUri)
    {
        $thread = DB::table('threads')->select('id')
                                   ->where('inBoardPseudoId', $threadPseudoId)
                                   ->where('boardUri', $boardUri)
                                   ->first();
        return $thread->id;
    }

    public function getBoardUriByThreadId($threadId)
    {
        return $this->where('id', $threadId)
                    ->first()
                    ->boardUri;
    }
}
