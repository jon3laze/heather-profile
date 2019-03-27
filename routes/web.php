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
    Route::post('/posts', 'PostController@store')->middleware('verified')->name('post');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::patch('/posts/{category}/{post}', 'PostController@update')->name('post.update');
    Route::delete('/posts/{category}/{post}', 'PostController@destroy');

    Route::post('locked-post/{post}', 'LockedPostController@store')->name('locked-post.store')->middleware('admin');
    Route::delete('locked-post/{post}', 'LockedPostController@destroy')->name('locked-post.destroy')->middleware('admin');

    Route::post('/posts/{category}/{post}/subscriptions', 'PostSubscriptionController@store');
    Route::delete('/posts/{category}/{post}/subscriptions', 'PostSubscriptionController@destroy');

    Route::post('/posts/{category}/{post}/comment', 'CommentController@store');
    Route::patch('/comments/{comment}', 'CommentController@update');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
    Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

    Route::post('/comments/{comment}/best', 'BestCommentController@store')->name('best-comment.store');
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

Route::get('api/users', 'Api\UserController@index');
Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');
