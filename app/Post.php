<?php

namespace App;

use App\Filters\PostFilters;
use App\Events\PostHasNewComment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'category'];

    protected $casts = [
        'locked' => 'boolean'
    ];

    protected $appends = ['hasSubscription'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('owner', function ($builder) {
            $builder->withCount('owner');
        });

        static::created(function ($post) {
            $post->update(['slug' => $post->title]);
        });

        static::deleting(function ($post) {
            $post->comments->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return "/posts/{$this->category->slug}/{$this->slug}";
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

        event(new PostHasNewComment($this, $comment));

        return $comment;
    }

    public function scopeFilter($query, PostFilters $filters)
    {
        return $filters->apply($query);
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

    public function hasUpdatesFor($user = null)
    {
        $user = $user ?: auth()->user();

        $key = $user->visitedPostCacheKey($this);

        return $this->updated_at > cache($key);
    }

    public function visits()
    {
        return new Visits($this);
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function saveBestComment(Comment $comment)
    {
        $this->update(['best_comment_id' => $comment->id]);
    }
}
