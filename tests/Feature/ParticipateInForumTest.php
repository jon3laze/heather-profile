<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    guests may not comment on posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function guests_may_not_comment_on_posts()
    {
        $this->withExceptionHandling()
            ->post('/posts/cat-dog/1/comment', [])
            ->assertRedirect('/login');
    }

    /**
     * @test    an authenticated user may comment on posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function an_authenticated_user_may_comment_on_posts()
    {
        $user = $this->signIn();

        $post = factory('App\Post')->create();

        $comment = factory('App\Comment')->make();

        $this->post($post->path() . '/comment', $comment->toArray());

        $this->assertDatabaseHas('comments', ['body' => $comment->body]);
    }

    /**
     * @test    it requires a body.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $post = factory('App\Post')->create();
        $comment = factory('App\Comment')->make(['body' => null]);

        $this->post($post->path() . '/comment', $comment->toArray())
            ->assertSessionHasErrors('body');
    }

    /**
     * @test    unauthorized users cannot delete comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function unauthorized_users_cannot_delete_comments()
    {
        $this->withExceptionHandling();

        $comment = factory('App\Comment')->create();

        $this->delete("/comments/{$comment->id}")
            ->assertRedirect('login');

        $this->signIn();
        $this->delete("/comments/{$comment->id}")
            ->assertStatus(403);
    }

    /**
     * @test    authorized users can delete their comment.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function authorized_users_can_delete_their_comment()
    {
        $this->signIn();

        $comment = factory('App\Comment')->create(['user_id' => auth()->id()]);

        $this->delete("/comments/{$comment->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    /**
     * @test    authorized users can update comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function authorized_users_can_update_comments()
    {
        $this->signIn();

        $comment = factory('App\Comment')->create(['user_id' => auth()->id()]);

        $updatedComment = 'A change has been made';
        $this->patch("/comments/{$comment->id}", ['body' => $updatedComment]);

        $this->assertDatabaseHas('comments', ['id' => $comment->id, 'body' => $updatedComment]);
    }

    /**
     * @test    unauthorized users cannot update comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function unauthorized_users_cannot_update_comments()
    {
        $this->withExceptionHandling();

        $comment = factory('App\Comment')->create();

        $this->patch("/comments/{$comment->id}")
            ->assertRedirect('login');

        $this->signIn();
        $this->patch("/comments/{$comment->id}")
            ->assertStatus(403);
    }

    /**
     * @test    comments that contain spam cannot be created.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function comments_that_contain_spam_cannot_be_created()
    {
        $this->signIn();

        $post = factory('App\Post')->create();
        $comment = factory('App\Comment')->make([
            'body' => 'Yahoo Customer Support'
        ]);

        $this->json('post', $post->path() . '/comment', $comment->toArray())
            ->assertStatus(422);
    }

    /**
     * @test    users may only comment once per minute.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function users_may_only_comment_once_per_minute()
    {
        $this->signIn(factory('App\User')->states('user')->create());

        $post = factory('App\Post')->create();

        $comment = factory('App\Comment')->make();

        $this->post($post->path() . '/comment', $comment->toArray())
            ->assertStatus(201);

        $this->post($post->path() . '/comment', $comment->toArray())
            ->assertStatus(429);
    }
}
