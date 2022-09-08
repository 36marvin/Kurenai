<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    private $userId;


    function createPost ($postTitle, $postBody, $userId, $threadId) {
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this-save();
    }

    function updatePost ($postId, $newBody, $newTitle) {
        
    }

    function deletePost ($postId) {
        
    }

    function highlightPost ($postId) {
        
    }
}
