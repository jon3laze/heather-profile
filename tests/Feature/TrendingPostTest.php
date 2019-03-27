<?php

namespace Tests\Feature;

use App\Trending;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrendingPostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->trending = new Trending();

        $this->trending->reset();
    }

    /**
     * @test    it increments a post score each time it is visited.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_increments_a_post_score_each_time_it_is_visited()
    {
        $this->assertEmpty($this->trending->get());

        $post = factory('App\Post')->create();

        $this->call('GET', $post->path());

        $this->assertCount(1, $trending = $this->trending->get());

        $this->assertEquals($post->title, $trending[0]->title);
    }
}
