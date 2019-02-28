<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    a category consists of posts.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function a_category_consists_of_posts()
    {
        $category = factory('App\Category')->create();
        $post = factory('App\Post')->create(['category_id' => $category->id]);

        $this->assertTrue($category->posts->contains($post));
    }
}
