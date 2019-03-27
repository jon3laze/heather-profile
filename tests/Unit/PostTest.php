<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use App\Notifications\PostWasUpdated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it has a path.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_path()
    {
        $post = factory('App\Post')->create();

        $this->assertEquals("/posts/{$post->category->slug}/{$post->slug}", $post->path());
    }

    /**
     * @test    it has comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_comments()
    {
        $post = factory('App\Post')->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $post->comments);
    }

    /**
     * @test    it has an owner.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_an_owner()
    {
        $post = factory('App\Post')->create();

        $this->assertInstanceOf('App\User', $post->owner);
    }

    /**
     * @test    it can add a comment.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_can_add_a_comment()
    {
        $post = factory('App\Post')->create();

        $post->addComment([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $post->comments);
    }

    /**
     * @test    it notifies subscribers when a comment is added.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_notifies_subscribers_when_a_comment_is_added()
    {
        Notification::fake();

        $post = factory('App\Post')->create();

        $this->signIn();

        $post->subscribe()->addComment([
            'body' => 'Foobar',
            'user_id' => 999
        ]);

        Notification::assertSentTo(auth()->user(), PostWasUpdated::class);
    }

    /**
     * @test    it belongs to a category.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_belongs_to_a_category()
    {
        $post = factory('App\Post')->create();

        $this->assertInstanceOf('App\Category', $post->category);
    }

    /**
     * @test    it can be subscribed to.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_can_be_subscribed_to()
    {
        $post = factory('App\Post')->create();

        $post->subscribe($userId = 1);

        $this->assertEquals(
            1,
            $post->subscriptions()->where('user_id', $userId)->count()
        );
    }

    /**
     * @test    it can be unsubscribed from.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_can_be_unsubscribed_from()
    {
        $post = factory('App\Post')->create();

        $post->subscribe($userId = 1);

        $post->unsubscribe($userId);

        $this->assertCount(0, $post->subscriptions);
    }

    /**
     * @test    it knows if the authenticated user has a subscription.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_knows_if_the_authenticated_user_has_a_subscription()
    {
        $post = factory('App\Post')->create();

        $this->signIn();

        $this->assertFalse($post->hasSubscription);

        $post->subscribe();

        $this->assertTrue($post->hasSubscription);
    }

    /**
     * @test    a post can check if the authenticated user has read all comments.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_can_check_if_the_authenticated_user_has_read_all_comments()
    {
        $this->signIn();

        $post = factory('App\Post')->create();

        $this->assertTrue($post->hasUpdatesFor(auth()->user()));

        auth()->user()->read($post);

        $this->assertFalse($post->hasUpdatesFor(auth()->user()));
    }

    /**
     * @test    a post records each visit.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_records_each_visit()
    {
        $post = factory('App\Post')->make(['id' => 1]);

        $post->visits()->reset();

        $this->assertSame(0, $post->visits()->count());

        $post->visits()->record();

        $this->assertEquals(1, $post->visits()->count());

        $post->visits()->record();

        $this->assertEquals(2, $post->visits()->count());
    }

    /**
     * @test    a post can be locked.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_can_be_locked()
    {
        $post = factory('App\Post')->create();

        $this->assertFalse($post->locked);

        $post->update(['locked' => true]);

        $this->assertTrue($post->locked);
    }
}
