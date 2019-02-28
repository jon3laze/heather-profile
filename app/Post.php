<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'category'];

    protected $appends = ['hasSubscription'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('owner', function ($builder) {
            $builder->withCount('owner');
        });

        static::deleting(function ($post) {
            $post->comments->each->delete();
        });
    }

    public function path()
    {
        return "/posts/{$this->category->slug}/{$this->id}";
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addComment($comment)
    {
        $comment = $this->comments()->create($comment);

        $this->subscriptions
            ->where('user_id', '!=', $comment->user_id)
            ->each
            ->notify($comment);

        return $comment;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(PostSubscription::class);
    }

    public function getHasSubscriptionAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }
}
