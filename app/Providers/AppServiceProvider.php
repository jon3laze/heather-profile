<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('posts.create', function ($view) {
            $categories = \Cache::rememberForever('categories', function () {
                return Category::all();
            });
            $view->with('categories', $categories);
        });

        \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }
}
