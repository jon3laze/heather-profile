<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    an event is fired on registration.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function an_event_is_fired_on_registration()
    {
        $this->withoutExceptionHandling();

        Event::fake();

        $user = [
            'name' => 'JonDoe',
            'email' => 'jon@doe.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $this->post(route('register'), $user);

        Event::assertDispatched(Registered::class, 1);
    }
}
