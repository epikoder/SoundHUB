<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Models\EliteArtists;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    use MediaQuery;

    public function indexRedirect(Request $request)
    {
        return redirect()->route('home/v1');
    }


    public function index(Request $request)
    {
        $tracks = $this->getAllTracks(12);
        $md = $this->mostDownloaded();
        $trend = $this->trend([15, 20]);

        return view('home', [
            'user' => $request->user(),
            'trend' => $trend,
            'tracks' => $tracks,
            'md' => $md,
        ]);
    }

    public function track(Request $request, $artist, $title)
    {
        if (!$request->exists('id')) return redirect()->route('home');
        $track = $this->getTrack($request->id);

        if (!$track) return redirect()->route('home');

        $img = $this->base64_to_image($track->art, storage_path('app') . DIRECTORY_SEPARATOR . 'track' . Str::random() . '.jpg');
        $mainColor = ($img) ? $this->mainColor($img) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($img);

        $artist = $this->getUser($track->trackable_type, $track->trackable_id);


        return view('track', [
            'user' => $request->user(),
            'track' => $track,
            'artist' => $artist,
            'mainColor' => $mainColor
        ]);
    }

    public function album(Request $request, $artist, $album)
    {
        if (!$request->exists('id')) return redirect()->route('home');
        $album = $this->getAlbum($request->id);
        if (!$album) return redirect()->route('home');

        $img = $this->base64_to_image($album->art, storage_path('app') . DIRECTORY_SEPARATOR . 'album' . Str::random() . '.jpg');
        $mainColor = ($img) ? $this->mainColor($img) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($img);

        return view('album', [
            'user' => $request->user(),
            'album' => $album,
            'user_id' => $album->user_id,
            'tracks' => $album->tracks,
            'mainColor' => $mainColor
        ]);
    }

    public function artist(Request $request, $name)
    {
        if (!$request->exists('id')) return redirect()->route('home');
        if ($request->id == 1) {
            $artist = EliteArtists::where('name', trim($name, "`\t\n\r\0\x0B\*\;\:"))->first();
            if (!$artist) return redirect()->route('home');

            $track = DB::table('tracks')->where('artist', $artist->name)->get();
            $album = DB::table('albums')->where('artist', $artist->name)->get();
        } else {
            $user = $this->getUserWithId($request->id);
            if (!$user) return redirect()->route('home');

            $track = $user->tracks;
            $album = $user->albums;
            $artist = $user->artists;
        }

        $img = $this->base64_to_image($artist->avatar, storage_path('app') . DIRECTORY_SEPARATOR . 'artist' . Str::random() . '.jpg');
        $mainColor = ($img) ? $this->mainColor($img) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($img);

        return view('artist', [
            'user' => $request->user(),
            'artist' => $artist,
            'album' => $album,
            'album_num' => count($album),
            'track' => $track,
            'track_num' => count($track),
            'mainColor' => $mainColor
        ]);
    }

    /**
     * Route for upload
     */
    public function upload(Request $request)
    {
        $user = $request->user();
        $artist = $user->artists;
        if (!$artist) {
            redirect()->route('login');
        }

        $genres = DB::table('genres')->get();
        Session::put('user', json_decode($request->user()->toJson()));
        return view('media.upload', [
            'genres' => $genres
        ]);
    }

    public function uploadAlbum(Request $request)
    {
        $artist = $request->user()->artists;
        if (!$artist) {
            redirect()->route('login');
        }
        $genres = DB::table('genres')->get();
        return view('media.uploadbulk', [
            'user' => $request->user(),
            'artist' => $artist,
            'genres' => $genres,
        ]);
    }
}
