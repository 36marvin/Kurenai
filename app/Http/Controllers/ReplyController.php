<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyModel;
use App\Models\ThreadModel;

class ReplyController extends Controller
{
    public function makeReply (ReplyModel $replyModel) 
    {
        $title = request('replyTitle');
        $body = request('replyBody');
        $threadId =  request('threadId');

        $replyModel->createReply($title, $body, $threadId);
    }
}
