<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Http\Forms\CreatePostForm;

class CommentController extends Controller
{
    public function index($categoryId, Post $post)
    {
        return $post->comments()->paginate(5);
    }

    public function store($categoryId, Post $post, CreatePostForm $form)
    {
        if ($post->locked) {
            return response('Locked', 423);
        }

        return $form->persist($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Comment destroyed']);
        }

        return back();
    }

    /**
     * Updated specified resource.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        request()->validate(['body' => 'required|spamfree']);

        $comment->update(request(['body']));
    }
}
