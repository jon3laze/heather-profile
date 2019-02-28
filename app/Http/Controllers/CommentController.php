<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

class CommentController extends Controller
{
    public function index($categoryId, Post $post)
    {
        return $post->comments()->paginate(5);
    }

    public function store($categoryId, Post $post)
    {
        $this->validate(request(), [
            'body' => 'required'
        ]);

        $comment = $post->addComment([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $comment->load('owner');
        }

        return back()
            ->with('flash', 'Your comment has been posted.');
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

    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update(request(['body']));

        return back();
    }
}
