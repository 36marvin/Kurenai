<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\PostModelParent;
use App\Models\ThreadModel;
use App\Models\BoardModel;

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

    protected $fillable = [
        'body',
        'title',
        'userId',
        'threadId',
        'inBoardPseudoId'
    ];

    const CREATED_AT = 'createdAt';

    const UPDATED_AT = 'updatedAt';

    function createReply ($replyTitle, $replyBody, $threadId) {
        $boardUri = App::make(ThreadModel::class)->getBoardUriByThreadId($threadId);
        $postCountCurrent = App::make(BoardModel::class)->getPostCount($boardUri);

        ReplyModel::create([
            'body' => $replyBody,
            'title' => $replyTitle,
            'threadId' => $threadId,
            'userId' => Auth::id(),
            'inBoardPseudoId' => $postCountCurrent == false ? 1 : $postCountCurrent + 1
        ]);

        // Adds 1 to the board's post count. It's better that this only happens after
        // the board was already created.
        App::make(BoardModel::class)->incrementBoardPostCount($boardUri);
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
        $repliesWithUsers = DB::table('replies')->leftJoin('users', 'replies.userId', '=', 'users.id')
                                                ->where('threadId', $threadId)
                                                ->select(
                                                    'title', 'body', 'createdAt', 'updatedAt', 'name as author',
                                                    'inBoardPseudoId'
                                                )
                                                ->orderBy('replies.createdAt', 'asc')
                                                ->paginate(100);
        return $repliesWithUsers;
    }
}
