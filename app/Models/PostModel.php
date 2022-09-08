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

    function createPost ($postTitle, $postBody) {

    }

    function updatePost ($postId, $newBody, $newTitle) {
        
    }

    function deletePost ($postId) {
        
    }

    function highlightPost ($postId) {
        
    }
}
