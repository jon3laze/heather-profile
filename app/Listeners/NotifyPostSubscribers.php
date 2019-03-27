<?php

namespace App\Listeners;

use App\Events\PostHasNewComment;

class NotifyPostSubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostHasNewComment  $event
     * @return void
     */
    public function handle(PostHasNewComment $event)
    {
        $event->post->subscriptions
            ->where('user_id', '!=', $event->comment->user_id)
            ->each
            ->notify($event->comment);
    }
}
