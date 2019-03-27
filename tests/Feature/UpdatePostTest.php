<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->signIn(factory('App\User')->states('user')->create());
    }

    /**
     * @test    a post can be updated.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_can_be_updated()
    {
        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $this->patch($post->path(), [
            'title' => 'Changed title',
            'body' => 'Changed body'
        ]);

        tap($post->fresh(), function ($post) {
            $this->assertEquals('Changed title', $post->title);
            $this->assertEquals('Changed body', $post->body);
        });
    }

    /**
     * @test    a post requires a title and body to be updated.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_requires_a_title_and_body_to_be_updated()
    {
        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $this->patch($post->path(), [])->assertSessionHasErrors('body');

        $this->patch($post->path(), [])->assertSessionHasErrors('title');
    }

    /**
     * @test    unauthorized users may not update posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function unauthorized_users_may_not_update_posts()
    {
        $post = factory('App\Post')->create(['user_id' => factory('App\User')->create()->id]);

        $this->patch($post->path(), [
            'title' => 'Changed title',
            'body' => 'Changed body'
        ])->assertStatus(403);
    }
}
