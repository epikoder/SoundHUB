<?php
namespace App\Http\Controllers\WEB\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait MediaHelper
{
    public function prepare (Request $request)
    {
        $validation = Validator::make($request->all(), [
            'art' => 'nullable|mimes:jpeg,bmp,png,webp',
            'track' => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
            'title' => 'required|string',
            'genre' => 'required|int',
            'c_genre' => 'nullable|string'
        ]
    );
        if ($validation->fails()) {
            return false;
        }

        $data['title'] = $request->title;
        $data['track'] = $request->file('track');
        $data['ext'] = $data['track']->getClientOriginalExtension();
        $data['user'] = $request->user();
        $data['artist'] = $data['user']->artists->name;
        $data['genre'] = $request->genre;
        $data['album'] = env('APP_NAME');
        $data['art'] = null;

        if ($request->art) {
            $data['append_art'] = $request->append_art;
            $data['art'] = $request->file('art');
            $art = Storage::putFileAs('songs/' . $data['artist'].'/images', $data['art'], $data['title'] . '.' .$data['art']->getClientOriginalExtension());
            $data['art'] = $art;
        }
        $data['track'] = Storage::putFileAs('songs/'.$data['artist'], $data['track'], $data['title'].'.'.$data['ext']);
        return $data;
    }

    /**
     * Requires :
     * user, feat, art, genre, title, track_title
     *
     * @return mixed
     */
    public function prepareBulk (Request $request)
    {
        $validation = Validator::make($request->all(), [
            'art' => 'nullable|mimes:jpeg,bmp,png',
            'title' => 'required|string',
            'num' => 'required|int'
        ]);
        if ($validation->fails() || ($request->num > 24)) {
            return false;
        }

        $data['album_artist'] = $request->user()->artists->name;
        //// TRACKS /////
        $tracks = json_decode('{}');
        for ($x = 1; $x <= $request->num; $x++) {
            if ($request->exists('check' . $x)) {
                $validation = Validator::make($request->all(), [
                    'feat' . $x => 'nullable|string',
                    'track' . $x => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
                    'title' . $x => 'required|string'
                ]);

                if ($validation->fails()) {
                    return false;
                }

                $title = 'title' . $x;
                $track = 'track' . $x;
                $var = json_decode('{}');

                $var->track = $request->$track;
                $var->title = $request->$title;
                $var->artist = $data['album_artist'];
                $var->feat = null;

                $feat = 'feat' . $x;
                if ($request->$feat) {
                    $feat = ' (feat ' . $request->$feat . ' )';
                    $var->feat = $feat;
                }
                $tracks->$x = $var;
            }
        }
        --$x;

        $data['user'] = $request->user();
        $data['art'] = null;
        $data['title'] = $request->title;
        $data['genre'] = $this->genre($request->genre, $request->c_genre);


        if ($request->art) {
            $data['append_art'] = $request->append_art;
            $art = $request->file('art');
            $data['art'] = Storage::putFileAs('songs/' . $data['album_artist'] . DIRECTORY_SEPARATOR . $data['title'], $art, 'front_cover' . '.' . $art->getClientOriginalExtension());
        }

        for ($a = 1; $a <= $x; $a++) {
            $tracks->$a->track = Storage::putFileAs('songs/' . $data['album_artist'] . DIRECTORY_SEPARATOR . $data['title'], $tracks->$a->track, $tracks->$a->title . '.' . $tracks->$a->track->getClientOriginalExtension());
        }

        $data['tracks'] = $tracks;
        $data['num'] = $x;
        return $data;
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
