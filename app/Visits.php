<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Visits
{
    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function record()
    {
        Redis::incr($this->cacheKey());

        return $this;
    }

    public function reset()
    {
        Redis::del($this->cacheKey());

        return $this;
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

    protected function cacheKey()
    {
        return "posts.{$this->post->id}.visits";
    }
}
