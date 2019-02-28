<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToPostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    a user can subscribe to a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_subscribe_to_a_post()
    {
        // Given we have a user
        $this->signIn();

        // And we have a post
        $post = factory('App\Post')->create();

        // The user then subscribes to the post
        $this->post($post->path() . '/subscriptions');

        $this->assertCount(1, $post->fresh()->subscriptions);
    }

    /**
     * @test    a user can unsubscribe from a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_unsubscribe_from_a_post()
    {
        // Given we have a user
        $this->signIn();

        // And we have a post
        $post = factory('App\Post')->create();

        // The user then subscribes to the post
        $post->subscribe();

        $this->delete($post->path() .'/subscriptions');

        $this->assertCount(0, $post->subscriptions);
    }
}
