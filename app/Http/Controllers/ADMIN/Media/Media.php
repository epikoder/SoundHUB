<?php

namespace App\Http\Controllers\ADMIN\Media;

use App\Http\Controllers\MediaQuery;
use App\Models\EliteArtists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

trait Media
{
    use MediaQuery;

    public function save(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'artist' => 'required|int',
            'art' => 'max:1024|mimes:jpeg,bmp,png',
            'track' => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
            'title' => 'required|string'
        ]);
        if ($validation->fails()) {
            return false;
        }

        $data['feat'] = null;
        if ($request->feat) {
            $data['feat'] = ' (feat ' . $request->feat . ' )';
        }
        $data['track'] = $request->file('track');
        $data['title'] = $request->title;
        $data['slug'] = $this->slugUnique($request->title, '\App\Models\Tracks');
        $data['artist'] = $this->artist($request->artist);
        $data['genre'] = $this->genre($request->genre, $request->c_genre);
        $data['admin'] = $request->user()->admins->uuid;
        $data['album'] = Config::get('app.name');
        $data['art'] = null;
        if ($request->art) {
            $data['append_art'] = $request->append_art;
            $art = $request->file('art');
            $data['art'] = Storage::putFileAs('songs/' . $data['artist']->name . '/images', $art, $data['title'] . '.' . $art->getClientOriginalExtension());
        }
        $data['track'] = Storage::putFileAs('songs/' . $data['artist']->name, $data['track'], $data['title'] . '.' . $data['track']->getClientOriginalExtension());
        return $data;
    }

    public function saveBulk(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'artist' => 'required|int',
            'art' => 'nullable|mimes:jpeg,bmp,png',
            'title' => 'required|string',
            'num' => 'required|int'
        ]);
        if ($validation->fails() || !$this->artist($request->artist)) {
            return 'Error: Album information';
        }
        //// TRACKS /////
        $tracks = json_decode('{}');
        for ($x = 1; $x <= $request->num; $x++) {
            if ($request->exists('check' . $x)) {
                $validation = Validator::make($request->all(), [
                    'artist' . $x => 'required|int',
                    'feat' . $x => 'nullable|string',
                    'track' . $x => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
                    'title' . $x => 'required|string'
                ]);
                if ($validation->fails()) {
                    return 'Error: Failed to validate track ' . $x;
                }
                $title = 'title' . $x;
                $artist = 'artist' . $x;
                $track = 'track' . $x;
                $var = json_decode('{}');
                $var->artist = ($this->artist($request->$artist))->name;
                $var->track = $request->$track;
                $var->title = $request->$title;
                $var->slug = $this->slugUnique($request->$title, '\App\Models\Albums');
                $var->feat = null;

                $feat = 'feat' . $x;
                if ($request->$feat) {
                    $feat = ' (feat ' . $request->$feat . ' )';
                    $var->feat = $feat;
                }
                $tracks->$x = $var;
            }
        }

        $data['artist'] = $this->artist($request->artist);
        $data['art'] = null;
        $data['title'] = $request->title;
        $data['slug'] = $this->slugUnique($request->title, '\App\Models\Albums');
        $data['genre'] = $this->genre($request->genre, $request->c_genre);
        $data['admin'] = $request->user()->admins->uuid;
        if ($request->art) {
            $data['append_art'] = $request->append_art;
            $art = $request->file('art');
            $data['art'] = Storage::putFileAs('songs/' . $data['artist']->name . DIRECTORY_SEPARATOR . $data['title'], $art, 'front_cover' . '.' . $art->getClientOriginalExtension());
        }
        --$x;
        for ($a = 1; $a <= $x; $a++) {
            $tracks->$a->track = Storage::putFileAs('songs/' . $data['artist']->name . DIRECTORY_SEPARATOR . $data['title'], $tracks->$a->track, $tracks->$a->title . '.' . $tracks->$a->track->getClientOriginalExtension());
        }
        $data['tracks'] = $tracks;
        $data['num'] = $x;
        return $data;
    }

    public function artist(int $artist)
    {
        return EliteArtists::find($artist);
    }

    public function genre(int $genre = null, string $c_genre = null)
    {
        if ($genre) {
            $val = DB::table('genres')->find($genre);
            return $val->name;
        }
        if ($c_genre) {
            return MediaQuery::escape_like($c_genre);
        }
        return Config::get('app.name');
    }
}
