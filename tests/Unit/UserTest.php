<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    a user can fetch their most recent reply.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_fetch_their_most_recent_reply()
    {
        $user = factory('App\User')->create();

        $comment = factory('App\Comment')->create(['user_id' => $user->id]);

        $this->assertEquals($comment->id, $user->lastComment->id);
    }

    /**
     * @test    a user can determine their avatar path.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_determine_their_avatar_path()
    {
        $user = factory('App\User')->create();

        $this->assertEquals(asset('images/avatars/image-1.png'), $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals(asset('avatars/me.jpg'), $user->avatar_path);
    }
}
