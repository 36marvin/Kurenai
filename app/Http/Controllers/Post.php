<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PostModel;

class Post extends Controller
{
    function createPost (Request $request, PostModel $postModel, User $user) {
        $userId = $request->session()->get('user_id');
        $postModel->createPost($request->postTitle, $request->postBody, $userId, $request->threadId);
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