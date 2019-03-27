<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BestCommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    creator may mark comment as best.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function creator_may_mark_comment_as_best()
    {
        $this->signIn();

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $comments = factory('App\Comment', 2)->create(['post_id' => $post->id]);

        $this->assertFalse($comments[1]->fresh()->fresh()->isBest());

        $this->postJson(route('best-comment.store', [$comments[1]->id]));

        $this->assertTrue($comments[1]->fresh()->fresh()->isBest());
    }

    /**
     * @test    only post creator can mark comment as best.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function only_post_creator_can_mark_comment_as_best()
    {
        $this->signIn();

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);

        $comments = factory('App\Comment', 3)->create(['post_id' => $post->id]);

        $this->signIn(factory('App\User')->create());

        $this->postJson(route('best-comment.store', [$comments[1]->id]))
            ->assertStatus(403);

        $this->assertFalse($comments[1]->fresh()->isBest());
    }

    /**
     * @test    if a best comment is deleted then the post is updated.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function if_a_best_comment_is_deleted_then_the_post_is_updated()
    {
        $this->signIn();

        $comment = factory('App\Comment')->create(['user_id' => auth()->id()]);

        $comment->post->saveBestComment($comment);

        $this->deleteJson(route('comment.destroy', $comment));

        $this->assertNull($comment->post->fresh()->best_comment_id);
    }
}
