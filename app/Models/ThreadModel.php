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

    /**
     *  Returns an array of the desired threads 
     *  with all attributes (locked, highlighted, etc.)
     */

    private function getNonPinnedThreadsPerPage($uri, $pagination) { 
        // laravel automatically detects the 'page' input of the current request
        return $self::where('board_uri', $uri)
                    ->where('is_pinned', false)
                    ->orderBy('created_at')
                    ->paginate($pagination)
                    ->get();
    }

    private function getPinnedThreadsPerPage($uri, $pagination) { 
        // laravel automatically detects the 'page' input of the current request
        return $self::where('board_uri', $uri)
                    ->where('is_pinned', true)
                    ->orderBy('last_pinned_at')
                    ->paginate($pagination)
                    ->get();
    }

    public function getAllThreads($uri, $pagination) {
        return getPinnedThreadsPerPage($uri, $pagination) + getNonPinnedThreadsPerPage($uri, $pagination);
    }
}
