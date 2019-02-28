<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    a user has a profile.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_has_a_profile()
    {
        $this->withoutExceptionHandling();

        $user = factory('App\User')->create();

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /**
     * @test    profiles display all posts by user.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function profiles_display_all_posts_by_user()
    {
        $this->signIn();

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $this->get("/profiles/" . auth()->user()->name)
            ->assertSee($post->title)
            ->assertSee($post->body);
    }
}
