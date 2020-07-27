<?php

namespace App\Http\Controllers\API\Routes;

use App\Http\Controllers\Controller;
use App\Tracks;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index ()
    {
        $tracks = Tracks::all('title');
        dd($tracks);
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
}
