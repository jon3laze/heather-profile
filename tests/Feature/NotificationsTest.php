<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /**
     * @test    a notification is prepared when a subscribed post receives a new comment.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_notification_is_prepared_when_a_subscribed_post_receives_a_new_comment()
    {
        $post = factory('App\Post')->create();

        $post->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        // // Then, each time a new comment is left
        $post->addComment([
            'user_id' => auth()->id(),
            'body' => 'Some comment here.'
        ]);

        // A notification should be prepared for the user.
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $post->addComment([
            'user_id' => factory('App\User')->create()->id,
            'body' => 'Some comment here.'
        ]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /**
     * @test    a user can fetch their unread notifications.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_fetch_their_unread_notifications()
    {
        factory(\Illuminate\Notifications\DatabaseNotification::class)->create();

        $this->assertCount(
            1,
            $this->getJson("/profiles/". auth()->user()->name . "/notifications")->json()
        );
    }

    /**
     * @test    a user can clear a notification.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_clear_a_notification()
    {
        factory(\Illuminate\Notifications\DatabaseNotification::class)->create();

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $this->delete("/profiles/{$user->name}/notifications/" . $user->unreadNotifications->first()->id);

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }
}
