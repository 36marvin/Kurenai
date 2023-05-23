<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\PostModelParent;
use App\Models\ThreadModel;

/**
 *   This class needs to provide some functions
 *   to the thread model.
 */

interface IlastReps {
    public function getLastThreadReplies($threadId, int $repliesPerThread): array;
}

class ReplyModel extends PostModelParent
{
    protected $table = 'replies';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    function createReply ($replyTitle, $replyBody, $threadId) {
        ReplyModel::create([
            'body' => $request->replyBody,
            'title' => $request->replyTitle,
            'threadId' => $request->threadId,
            'userId' => Auth::id(),
        ]);
    }

    function deleteReply ($replyId) {
        
    }

    function highlightReply ($replyId) {
        
    }
    /**
     *  For the thread index.
     */
    public function getReplyPostsWithUsers($threadId)
    {
        $replies = DB::table('replies')->where('threadId', $threadId)
                                       ->orderBy('created_at', 'desc')
                                       ->paginate(100);
    }
    
}
