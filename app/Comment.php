<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function path()
    {
        return "{$this->post->path()}#{$this->id}";
    }
}
