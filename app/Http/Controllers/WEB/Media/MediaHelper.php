<?php
namespace App\Http\Controllers\WEB\Media;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait MediaHelper
{
    public function prepare (Request $request)
    {
        $validation = Validator::make($request->all(), [
            'art' => 'mimes:jpeg,bmp,png',
            'track' => 'required|max:15360|mimes:audio/mpeg,mpga,opus,oga,flac,webm,weba,wav,ogg,m4a,mp3,mid,amr,aiff,wma,au,acc',
            'title' => 'required|string'
        ]);
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
        $data['art'] = '';

        if ($request->hasFile('art')) {
            $data['checkbox'] = $request->write;
            $data['art'] = $request->file('art');
            $art = Storage::putFileAs('songs/' . $data['artist'].'/images', $data['art'], $data['title'] . '.' .$data['art']->getClientOriginalExtension());
            $data['art'] = $art;
        }
        $data['track'] = Storage::putFileAs('songs/'.$data['artist'], $data['track'], $data['title'].'.'.$data['ext']);
        return $data;
    }

    public function prepareBulk (Request $request)
    {
    }
    public function genre(int $genre, string $c_genre = null)
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
