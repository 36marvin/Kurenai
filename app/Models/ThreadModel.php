<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\PostModelParent;

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
}
