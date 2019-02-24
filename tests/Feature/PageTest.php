<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test    it has a home page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_home_page()
    {
        $this->get('/')->assertStatus(200);
    }

    /**
     * @test    it has an about page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_an_about_page()
    {
        $this->get('/about')->assertStatus(200);
    }

    /**
     * @test    it has a projects page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_projects_page()
    {
        $this->get('/projects')->assertStatus(200);
    }

    /**
     * @test    it has a writing page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_writing_page()
    {
        $this->get('/writing')->assertStatus(200);
    }

    /**
     * @test    it has a contact page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_contact_page()
    {
        $this->get('/contact')->assertStatus(200);
    }

    /**
     * @test    it has a login page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_login_page()
    {
        $this->get('/login')->assertStatus(200);
    }

    /**
     * @test    it has a register page.
     *
     * @author    Jon Ouellette
     * @return    void
     */
    public function it_has_a_register_page()
    {
        $this->get('/')
    }
}
