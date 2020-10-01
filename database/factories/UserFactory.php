<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Artists;
use App\Models\EliteArtists;
use App\Models\Tracks;
use App\User;
use Faker\Generator as Faker;
use App\Http\Controllers\MediaQuery;
use App\Models\Albums;
use App\Models\PlayCount;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // password
    ];
});
$factory->define(Artists::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->userName
    ];
});
$factory->define(EliteArtists::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->firstName()
    ];
});

$factory->define(Tracks::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(rand(2, 3));
    return [
        'title' => $title,
        'slug' => MediaQuery::slugUnique($title, '\App\Models\Tracks'),
        'genre' => 'blues',
        'url' => 'url',
    ];
});

$factory->define(Albums::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(rand(2,3));
    return [
        'title' => $title,
        'slug' => MediaQuery::slugUnique($title, '\App\Models\Albums'),
        'genre' => 'rap',
        'track_num' => rand(3,24)
    ];
});

$factory->define(\App\Models\PlayCount::class, function () {
    return [
        'count' => (rand() % rand()) % rand()
    ];
});
