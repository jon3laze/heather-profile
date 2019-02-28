<?php

namespace Tests\Unit;

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
}
