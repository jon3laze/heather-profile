<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner'];

    protected $appends = ['isBest'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            $comment->post->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->post->decrement('comments_count');
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function mentionedUsers()
    {
        preg_match_all('/\@([\w\-\_]+)/', $this->body, $matches);

        return $matches[1];
    }

    public function path()
    {
        return "{$this->post->path()}#{$this->id}";
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace('/@([\w\-\_]+)/', '<a href="/profiles/$1">$0</a>', $body);
    }

    public function isBest()
    {
        return $this->post->best_comment_id == $this->id;
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }
}
