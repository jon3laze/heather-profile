<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Trending
{
    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 8));
    }

    public function push($post)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $post->title,
            'path' => $post->path()
        ]));
    }

    public function cacheKey()
    {
        return app()->environment('testing') ? 'tt_trending_posts' : 'trending_posts';
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}
