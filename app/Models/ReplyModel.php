<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\PostModelParent;

class ReplyModel extends PostModelParent
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
}
