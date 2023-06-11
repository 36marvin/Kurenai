<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ThreadModel;
use App\Models\ReplyModel;

class Thread extends Controller

{
    public function serveThreadIndex(ThreadModel $threadModel, ReplyModel $replyModel) 
    {
        $threadPseudoId = request()->route()->parameter('threadPseudoId');
        $threadsBoardUri = request()->route()->parameter('boardUri');

        $threadId = $threadModel->getThreadIdByPseudoId($threadPseudoId, $threadsBoardUri);

        $op = $threadModel->getThreadPostAndUser($threadPseudoId, $threadsBoardUri);
        $replies = $replyModel->getReplyPostsWithUsers($threadId);

        return view('thread-index')->with('op', $op)
                                   ->with('replies', $replies);
    }

    public function makeThread (Request $request, User $user, ThreadModel $thread)
    {
        // if(hasAnyOfThesePermissions([
        //                             'mod2',
        //                             'mod3',
        //                             'admin',
        //                             'auxManager1',
        //                             'auxManager2'
        //                             ],
        //                             Auth::id()
        //                            )
        // ) {$threadConfig = [
        //         'isLocked' => $request->isLocked,
        //         'isInfinite' => $request->isInfinite,
        //         'isPinned' => $request->isPinned,
        //         'isCensored' => $request->isCensored
        //     ];
        // } else {
        //     $threadConfig = [
        //         'isLocked' => false,
        //         'isInfinite' => false,
        //         'isPinned' => false,
        //         'isCensored' => false
        //     ];
        // }


        $title = request('title');
        $body = request('body');
        $boardUri = request('boardUri');
        $userId = Auth::id();

        $threadConfig = [
            'isLocked' => request('isLocked') === 'true' ? true : false,
            'isInfinite' => request('isInfinite') === 'true' ? true : false,
            'isPinned' => request('isPinned') === 'true' ? true : false,
            'isCensored' => request('isCensored') === 'true' ? true : false
        ];

        $thread->newThread($title, $body, $boardUri, $userId, $threadConfig);

        return redirect("/board/$boardUri");
    }

    function updateThread (Request $request, ThreadModel $thread) {
        $thread->updateThread($request->input('newBody'),
                              $request->input('newTitle'),
                              $request->input('threadId')
                             );
    }

    function lockThread (Request $request, ThreadModel $thread) {
        $thread->lockThread($request->input('threadId'));
    }

    function makeInfinite (Request $request, ThreadModel $thread) {
        $thread->makeInfinite($request->input('threadId'));
    }

    function deleteThread (Request $request, ThreadModel $thread) {
        $thread->deleteThread($request->input('threadId'));
    }

    function highlight (Request $request, ThreadModel $thread) {
        $thread->highlight($request->input('threadId'));
    }
}
