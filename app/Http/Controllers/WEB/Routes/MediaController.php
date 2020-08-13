<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Http\Controllers\Controller;
use App\Tracks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $tracks = Tracks::all('title');
        Cookie::queue('tracks', $tracks, 60, '/', env('SESSION_DOMAIN'), env('SESSION_SECURE_COOKIE'));
        return view('home', [
            'user' => $request->user()
        ]);
    }

    public function upload(Request $request)
    {
        $artist = $request->user()->artists;
        if (!$artist) {
            return view('login');
        }

        return view('media.upload', [
            'artist' => $artist
        ]);
    }

    public function album (Request $request) {
        $artist = $request->user()->artists;
        if (!$artist) {
            return view('login');
        }
        $genres = DB::table('genres')->get();
        return view('media.uploadbulk',[
            'user' => $request->user(),
            'artist' => $artist,
            'genres' => $genres
        ]);
    }
}
