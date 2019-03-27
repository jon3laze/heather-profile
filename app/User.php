<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'email_verified_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function lastComment()
    {
        return $this->hasOne(Comment::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function isAdmin()
    {
        return in_array($this->id, [1, 3], true);
    }

    public function read($post)
    {
        cache()->forever(
            $this->visitedPostCacheKey($post),
            Carbon::now()
        );
    }

    public function getAvatarPathAttribute($avatar)
    {
        return asset($avatar ?: 'images/avatars/image-1.png');
    }

    public function visitedPostCacheKey($post)
    {
        return sprintf("users.%s.visits.%s", $this->id, $post->id);
    }
}
