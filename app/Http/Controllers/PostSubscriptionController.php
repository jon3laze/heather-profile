<?php

namespace App\Http\Controllers;

use App\Post;

class PostSubscriptionController extends Controller
{
    public function store($categoryId, Post $post)
    {
        $post->subscribe();
    }

    public function destroy($categoryId, Post $post)
    {
        $post->unsubscribe();
    }
}
