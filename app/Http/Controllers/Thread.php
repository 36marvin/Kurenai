<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\ThreadModel;

class Thread extends Controller

{
    function makeThread (Request $request, User $user, ThreadModel $thread) {
        $userId = $request->session()->get('user_id');

        $thread->makeThread($request->input('threadBody'), 
                            $request->input('threadTitle'), 
                            $request->input('isLocked'), 
                            $request->input('isInfinite'), 
                            $request->input('allowHtml'),
                            $userId
                           );
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
