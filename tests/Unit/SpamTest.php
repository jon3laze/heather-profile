<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Inspections\Spam;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it checks for invalid keywords.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_checks_for_invalid_keywords()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Regular comment that is allowed.'));

        $this->expectException('Exception');

        $spam->detect('Comment with yahoo customer support in it.');
    }

    /**
     * @test    it checks for any key held down.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_checks_for_any_key_held_down()
    {
        $spam = new Spam();

        $this->expectException('Exception');

        $spam->detect('Hello world aaaaaaaaaaaaaaaa');
    }
}
