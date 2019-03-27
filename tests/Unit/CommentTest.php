<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it has an owner.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_an_owner()
    {
        $comment = factory('App\Comment')->create();

        $this->assertInstanceOf('App\User', $comment->owner);
    }

    /**
     * @test    it knows if it was just posted.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_knows_if_it_was_just_posted()
    {
        $comment = factory('App\Comment')->create();

        $this->assertTrue($comment->wasJustPublished());

        $comment->created_at = Carbon::now()->subMonth();

        $this->assertFalse($comment->wasJustPublished());
    }

    /**
     * @test    it can detect all mentioned users in the body.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $comment = new \App\Comment(['body' => '@JaneDoe wants to talk to @JonDoe']);

        $this->assertEquals(['JaneDoe', 'JonDoe'], $comment->mentionedUsers());
    }

    /**
     * @test    it wraps mentioned usernames in anchor tags.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_wraps_mentioned_usernames_in_anchor_tags()
    {
        $comment = new \App\Comment(['body' => 'Hello @Jane_Doe.']);

        $this->assertEquals(
            'Hello <a href="/profiles/Jane_Doe">@Jane_Doe</a>.',
            $comment->body
        );
    }

    /**
     * @test    it knows if it is the best comment.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_knows_if_it_is_the_best_comment()
    {
        $comment = factory('App\Comment')->create();

        $this->assertFalse($comment->isBest());

        $comment->post->update(['best_comment_id' => $comment->id]);

        $this->assertTrue($comment->isBest());
    }
}
