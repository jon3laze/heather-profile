<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/create', 'PostController@create')->name('create-post');
    Route::delete('/posts/{category}/{post}', 'PostController@destroy');

    Route::post('/posts/{category}/{post}/subscriptions', 'PostSubscriptionController@store');
    Route::delete('/posts/{category}/{post}/subscriptions', 'PostSubscriptionController@destroy');

    Route::post('/posts/{category}/{post}/comment', 'CommentController@store');
    Route::patch('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@destroy');

    Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
    Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');
});

Route::get('/posts/{category}/{post}/comment', 'CommentController@index');

Route::get('/', 'PageController@index')->name('home');

Route::get('/about', 'PageController@about')->name('about');
Route::get('/projects', 'PageController@project')->name('projects');
Route::get('/color-scheme', 'PageController@color')->name('color-scheme');
Route::get('/writing', 'PageController@writing')->name('writing');
Route::get('/contact', 'PageController@contact')->name('contact');

Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/{category}', 'PostController@index');
Route::get('/posts/{category}/{post}', 'PostController@show');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');
