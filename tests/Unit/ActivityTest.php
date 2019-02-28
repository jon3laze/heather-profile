<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it records an activity when a post is created.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_records_an_activity_when_a_post_is_created()
    {
        $this->signIn();

        $post = factory('App\Post')->create();

        $this->assertDatabaseHas('activities', [
            'type' => 'created_post',
            'user_id' => auth()->id(),
            'subject_id' => $post->id,
            'subject_type' => 'App\Post'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $post->id);
    }

    /**
     * @test    it records activity when a comment is created.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_records_activity_when_a_comment_is_created()
    {
        $this->signIn();

        $comment = factory('App\Comment')->create();

        $this->assertEquals(2, Activity::count());
    }

    /**
     * @test    it fetches a feed for any user.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        $now = Carbon::now()->toDateTimeString();

        $lastWeek = Carbon::now()->subWeek()->toDateTimeString();

        factory('App\Post')->create(['user_id' => auth()->id(), 'created_at' => $now]);
        factory('App\Post')->create(['user_id' => auth()->id(), 'created_at' => $lastWeek]);

        auth()->user()->activity()->first()->update(['created_at' => $lastWeek]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->contains('created_at', $now));

        $this->assertTrue($feed->contains('created_at', $lastWeek));
    }
}
