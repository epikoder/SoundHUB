<?php

namespace App\Http\Controllers\ADMIN\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
trait Media
{

    public function save(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'artist' => 'required|int',
            'art' => 'mimes:jpeg,bmp,png',
            'track' => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
            'title' => 'required|string'
        ]);
        if ($validation->fails()) {
            return false;
        }

        $data['feat'] = null;
        if ($request->feat) {
            $data['feat'] = ' (feat '. $request->feat . ' )';
        }
        $data['track'] = $request->file('track');
        $data['title'] = $request->title;
        $data['artist'] = $this->artist($request->artist);
        $data['genre'] = $this->genre($request->genre, $request->c_genre);
        $data['admin'] = $request->user()->admins->uuid;
        $data['album'] = env('APP_NAME');
        $data['art'] = null;
        if ($request->exists('art')) {
            $art = $request->file('art');
            $data['art'] = Storage::putFileAs('songs/' . $data['artist'] . '/images', $art, $data['title'] . '.' . $art->getClientOriginalExtension());
        }
        $data['track'] = Storage::putFileAs('songs/' . $data['artist'], $data['track'], $data['title'] . '.' . $data['track']->getClientOriginalExtension());
        return $data;
    }

    public function saveBulk(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'artist' => 'required|int',
            'art' => 'nullable|mimes:jpeg,bmp,png',
            'title' => 'required|string'
        ]);
        if ($validation->fails() || ($request->num > 24)) {
            return false;
        }
        //// TRACKS /////
        $tracks = [];
        $i = 0;
        for ($x = 1; $x <= $request->num; $x++) {
            if ($request->exists('check' . $x)) {
                $validation = Validator::make($request->all(), [
                    'artist' . $x => 'required|int',
                    'track' . $x => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
                    'title' . $x => 'required|string'
                ]);
                if ($validation->fails()) {
                    return false;
                }
                $title = 'title'.$x;
                $artist = 'artist'.$x;
                $track = 'track'.$x;
                $tracks = json_decode('{}'); $var = json_decode('{}');
                $var->artist = $request->$artist;
                $var->track = $request->$track;
                $var->title = $request->$title;
                $var->feat = null;
                
                $feat = 'feat'.$x;
                if ($request->$feat) {
                    $feat = ' (feat '.$request->$feat.' )';
                    $var->feat = $feat;
                }
                $tracks->$x = $var;
            }
        }
        $data['album_artist'] = $request->artist;
        $data['art'] = null;
        $data['title'] = $request->title;
        $data['genre'] = $this->genre($request->genre, $request->c_genre);
        $data['admin'] = $request->user()->admins->uuid;
        if ($request->art) {
            $art = $request->file('art');
            $data['art'] = Storage::putFileAs('songs/' . $data['album_artist'].DIRECTORY_SEPARATOR.$data['title'], $art, 'front_cover'. '.' . $art->getClientOriginalExtension());
        }
        for ($a = 1; $a <= $i; $a++) {
            $tracks->$a->track = Storage::putFileAs('songs/' . $data['album_artist'].DIRECTORY_SEPARATOR.$data['title'], $tracks->$a->track, $tracks->$a->title . '.' . $tracks->$a->track->getClientOriginalExtension());
        }
        $data['tracks'] = $tracks;
        $data['num'] = $i;
        return $data;
    }

    public function artist(int $artist)
    {
        return (DB::table('elite_artist')->find($artist))->name;
    }

    public function genre(int $genre = null, string $c_genre = null)
    {
        if ($genre) {
            $val = DB::table('genres')->find($genre);
            return $val->name;
        }
        if ($c_genre) {
            return trim($c_genre);
        }
        return env('APP_NAME');
    }
}
