<?php

use App\Models\Albums;
use App\Models\Artists;
use App\Models\EliteArtists;
use App\Models\Tracks;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @param Faker $faker
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            $user->artists()->save(factory(Artists::class)->make())->each(function ($a) {
                /*
                $a->tracks()->createMany(factory(Tracks::class, 12)->make([
                    'artist' => $a->name
                ])->toArray())->each(function ($track) {
                    $track->playcount()->save(factory(\App\Models\PlayCount::class)->make([
                        'title' => $track->title
                    ]));
                });
                $a->albums()->createMany(factory(Albums::class, 7)->make([
                    'artist' => $a->name
                ])->toArray())->each(function ($album) {
                    $album->tracks()->createMany(factory(Tracks::class, $album->track_num)->make([
                        'artist' => $album->artist
                    ])->toArray())->each(function ($track) {
                        $track->playcount()->save(factory(\App\Models\PlayCount::class)->make([
                            'title' => $track->title
                        ]));
                    });
                });
                */
            });
        });

        factory(User::class, 10)->create()->each(function ($user) {
            $user->eliteArtists()->save(factory(EliteArtists::class)->make())->each(function ($a) {
                /*
                $a->tracks()->createMany(factory(Tracks::class, 12)->make([
                    'artist' => $a->name
                    ])->toArray())->each(function ($track) {
                    $track->playcount()->save(factory(\App\Models\PlayCount::class)->make([
                        'title' => $track->title
                    ]));
                });
                $a->albums()->createMany(factory(Albums::class, 7)->make([
                    'artist' => $a->name
                    ])->toArray())->each(function ($album) {
                        $album->tracks()->createMany(factory(Tracks::class, $album->track_num)->make([
                            'artist' => $album->artist
                        ])->toArray())->each(function ($track) {
                            $track->playcount()->save(factory(\App\Models\PlayCount::class)->make([
                                'title' => $track->title
                            ]));
                        });
                    });
                    */
            });
        });
    }
}
