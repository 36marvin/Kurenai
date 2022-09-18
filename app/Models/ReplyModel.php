<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\PostModelParent;
use App\Http\Models\ThreadModel;

/**
 *   This class needs to provide some functions
 *   to the thread model.
 */

interface IlastReps {
    public function getLastThreadReplies($threadId, int $repliesPerThread): array;
}

class ReplyModel extends PostModelParent implements Ithreads
{
    protected $table = 'replies';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    function createReply ($replyTitle, $replyBody, $userId, $threadId) {
        $this->title = $replyTitle;
        $this->body = $this->formatBody($replyBody);
        $this->userId = $userId;
        $this-save();
    }

    function deleteReply ($replyId) {
        
    }

    function highlightReply ($replyId) {
        
    }

    public function getLastThreadReplies ($threadId, int $repliesPerThread) {
        return $self::where('thread_id', $threadId)
                    ->orderBy('created_at', 'desc')
                    ->limit($repliesPerThread)
                    ->get();
    }
    
}
