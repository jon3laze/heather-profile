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
Auth::routes();

Route::get('/', 'PageController@index')->name('home');

Route::get('/about', 'PageController@about')->name('about');

Route::get('/projects', 'PageController@project')->name('projects');
Route::get('/projects/art', 'PageController@art');
Route::get('/projects/code', 'PageController@code');
Route::get('/projects/music', 'PageController@music');

Route::get('/writing', 'PageController@writing')->name('writing');

Route::get('/contact', 'PageController@contact')->name('contact');
