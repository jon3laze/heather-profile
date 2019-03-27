<?php

namespace App\Listeners;

use App\User;
use App\Notifications\YouWereMentioned;

class NotifyMentionedUsers
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        User::whereIn('name', $event->comment->mentionedUsers())
            ->get()
            ->each(function ($user) use ($event) {
                $user->notify(new YouWereMentioned($event->comment));
            });
    }
}
