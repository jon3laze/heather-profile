<?php

namespace Tests\Feature;

use App\Activity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    a guest can view all posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_guest_can_view_all_posts()
    {
        $post = factory('App\Post')->create();

        $this->get('/posts')
            ->assertSee($post->title);
    }

    /**
     * @test    a guest can view a single post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_guest_can_view_a_single_post()
    {
        $post = factory('App\Post')->create();

        $this->get($post->path())
            ->assertSee($post->title);
    }

    /**
     * @test    an authenticated user can create a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function an_authenticated_user_can_create_a_post()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $post = factory('App\Post')->make();

        $response = $this->post('/posts', $post->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    /**
     * @test    a guest cannot create a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_guest_cannot_create_a_post()
    {
        $this->get('/posts/create')
            ->assertRedirect('/login');

        $this->post('/posts')
            ->assertRedirect('/login');
    }

    /**
     * @test    a post requires a title.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_requires_a_title()
    {
        $this->publishPost(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * @test    a post requires a body.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_requires_a_body()
    {
        $this->publishPost(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test    a post requires a valid category.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_post_requires_a_valid_category()
    {
        factory('App\Category', 2)->create();

        $this->publishPost(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->publishPost(['category_id' => 999])
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test    posts can be filtered by category.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function posts_can_be_filtered_by_category()
    {
        $this->withoutExceptionHandling();

        $category = factory('App\Category')->create();
        $postInCategory = factory('App\Post')->create(['category_id' => $category->id]);
        $postNotInCategory = factory('App\Post')->create();

        $this->get('/posts/' . $category->slug)
            ->assertSee($postInCategory->title)
            ->assertDontSee($postNotInCategory->title);
    }

    /**
     * @test    unauthorized users cannot delete posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function unauthorized_users_cannot_delete_posts()
    {
        $post = factory('App\Post')->create();

        $response = $this->delete($post->path())->assertRedirect('/login');

        $this->signIn();
        $this->delete($post->path())->assertStatus(403);
    }

    /**
     * @test    authorized users can delete a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function authorized_users_can_delete_a_post()
    {
        $this->signIn();

        $post = factory('App\Post')->create(['user_id' => auth()->id()]);
        $comment = factory('App\Comment')->create(['post_id' => $post->id]);

        $response = $this->json('DELETE', $post->path());

        $response->assertStatus(204);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);

        $this->assertEquals(2, Activity::count());
    }

    public function publishPost($attributes = [])
    {
        $this->signIn();

        $post = factory('App\Post')->make($attributes);

        return $this->post('/posts', $post->toArray());
    }

    /**
     * @test    a user can request all comments for a post.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_user_can_request_all_comments_for_a_post()
    {
        $post = factory('App\Post')->create();
        factory('App\Comment', 10)->create(['post_id' => $post->id]);

        $response = $this->getJson($post->path() . '/comment')->json();

        $this->assertCount(5, $response['data']);
        $this->assertEquals(10, $response['total']);
    }
}
