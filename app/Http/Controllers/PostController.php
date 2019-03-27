<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Trending;
use App\Rules\Recaptcha;
use App\Filters\PostFilters;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, PostFilters $filters, Trending $trending)
    {
        $posts = $this->getPosts($category, $filters);

        if (request()->wantsJson()) {
            return $posts;
        }

        return view('posts.index', [
            'posts' => $posts,
            'trending' => $trending->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Recaptcha $recaptcha)
    {
        request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'category_id' => 'required|exists:categories,id',
            'g-recaptcha-response' => ['required', $recaptcha]
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => request('category_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        if (request()->wantsJson()) {
            return response($post, 201);
        }

        return redirect($post->path())
            ->with('flash', 'Article has been published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, Post $post, Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($post);
        }

        $trending->push($post);

        $post->visits()->record();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($categoryId, Post $post)
    {
        $this->authorize('update', $post);

        $post->update(request()->validate([
            'title' => 'required|spamfree',
            'body' => 'required|spamfree'
        ]));

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($category, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/posts')
            ->with('flash', 'Article has been destroyed.');
    }

    protected function getPosts(Category $category, PostFilters $filters)
    {
        $posts = Post::latest()->filter($filters);

        if ($category->exists) {
            $posts->where('category_id', $category->id);
        }

        return $posts->paginate(10);
    }
}
