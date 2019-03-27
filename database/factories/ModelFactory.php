<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    $title = Str::limit($faker->catchPhrase, 50, '');
    return [
        'slug' => Str::slug($title, '-'),
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'category_id' => function () {
            return factory('App\Category')->create()->id;
        },
        'title' => $title,
        'body' => $faker->paragraph,
        'locked' => false
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'post_id' => function () {
            return factory('App\Post')->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    $name = Str::limit($faker->catchPhrase, 20, '');
    return [
        'name' => $name,
        'slug' => Str::slug($name, '-'),
    ];
});

$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\PostWasUpdated',
        'notifiable_id' => function () {
            return auth()->id() ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['message' => $faker->sentence]
    ];
});

$factory->state(App\User::class, 'administrator', function () {
    return [
        'id' => 1
    ];
});

$factory->state(App\User::class, 'user', function () {
    $id = App\User::max('id') + 2;
    return [
        'id' => $id
    ];
});
