<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LockPostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    non administrators may not lock posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function non_administrators_may_not_lock_posts()
    {
        $this->signIn(factory('App\User')->states('user')->create());

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $this->post(route('locked-post.store', $post))->assertStatus(403);

        $this->assertFalse($post->fresh()->locked);
    }

    /**
     * @test    administrators can lock posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function administrators_can_lock_posts()
    {
        $this->withoutExceptionHandling();

        $this->signIn(factory('App\User')->states('administrator')->create());

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $this->post(route('locked-post.store', $post));

        $this->assertTrue($post->fresh()->locked, 'Failed asserting that the post was locked.');
    }

    /**
     * @test    administrators can unlock posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function administrators_can_unlock_posts()
    {
        $this->signIn(factory('App\User')->states('administrator')->create());

        $post = factory('App\Post')->create([
            'user_id' => auth()->id(),
            'locked' => true
        ]);

        $this->delete(route('locked-post.destroy', $post));

        $this->assertFalse($post->fresh()->locked, 'Failed asserting that the post was unlocked.');
    }

    /**
     * @test    locked posts cannot receive new comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function locked_posts_cannot_receive_new_comments()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $post = factory('App\Post')->create();

        $post->update(['locked' => true]);

        $this->post($post->path() . '/comment', [
            'body' => 'Foobar',
            'user_id' => auth()->id()
        ])->assertStatus(423);
    }
}
