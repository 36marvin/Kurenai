<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Post extends Controller
{
    function createPost (PostModel $postModel) {
        $postModel->createPost($postTitle, $postBody);
    }

    function updatePost ($postId, $newBody, $newTitle, PostModel $postModel) {
        $postModel->updatePost($postId, $newBody, $newTitle);
    }

    function deletePost ($postId, PostModel $postModel) {
        $postModel->deletePost($postId);
    }

    function highlightPost ($postId, PostModel $postModel) {
        $postModel->hightlightPost($postId);
    }
}