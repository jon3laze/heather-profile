<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class YouWereMentioned extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->comment->owner->name . ' mentioned you in ' . $this->comment->post->title)
                    ->action('View Comment', url($this->comment->path()));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->comment->owner->name . ' mentioned you in ' . $this->comment->post->title,
            'link' => $this->comment->path()
        ];
    }
}
