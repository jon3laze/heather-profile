<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show the projects landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function project()
    {
        return view('pages.project');
    }

    /**
     * Show the writing landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function writing()
    {
        return view('pages.writing');
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Show the color scheme page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function color()
    {
        return view('pages.color');
    }
}
