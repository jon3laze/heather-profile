<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    mentioned users in a comment are notified.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function mentioned_users_in_a_comment_are_notified()
    {
        $jonDoe = factory('App\User')->create(['name' => 'JonDoe']);

        $this->signIn($jonDoe);

        $janeDoe = factory('App\User')->create(['name' => 'JaneDoe']);

        $post = factory('App\Post')->create();

        $comment = factory('App\Comment')->make([
            'body' => '@JaneDoe look at this. @FrankDoe would be interested as well.'
        ]);

        $this->json('post', $post->path() . '/comment', $comment->toArray());

        $this->assertCount(1, $janeDoe->notifications);
    }

    /**
     * @test    it can fetch all mentioned users.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_can_fetch_all_mentioned_users()
    {
        factory('App\User')->create(['name' => 'jondoe']);
        factory('App\User')->create(['name' => 'janedoe']);
        factory('App\User')->create(['name' => 'jonbonjovi']);

        $results = $this->json('GET', '/api/users', ['name' => 'jon']);

        $this->assertCount(2, $results->json());
    }
}
