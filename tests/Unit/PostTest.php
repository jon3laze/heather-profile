<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it has a category in the path.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_category_in_the_path()
    {
        $post = factory('App\Post')->create();

        $this->assertEquals("/posts/{$post->category->slug}/{$post->id}", $post->path());
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
}
