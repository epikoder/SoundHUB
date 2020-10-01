<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Models\EliteArtists;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaQuery;
use App\Http\Middleware\Regs;
use App\Models\Artists;
use App\Models\PlayCount;
use App\Models\Tracks;
use App\User;
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
        $trend = $this->trending();
        $recent = $this->getNewTracks()->shuffle();
        $md = $this->trending(10);

        return view('home', [
            'user' => $request->user(),
            'trend' => $trend,
            'recent' => $recent,
            'md' => $md
        ]);
    }

    //////// TRACKS
    public function tracks(Request $request, $artist, $slug)
    {
        $track = $this->getTrackWithSlug($slug);
        if (!$track || $track->artist != $artist) {
            abort(404);
        }

        $img = $this->base64_to_image($track->art, storage_path('app') . DIRECTORY_SEPARATOR . 'track' . Str::random() . '.jpg');
        $mainColor = ($img) ? $this->mainColor($img) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($img);

        return view('track', [
            'user' => $request->user(),
            'track' => $track,
            'mainColor' => $mainColor
        ]);
    }

    public function allArtistTracks(Request $request, $artist)
    {
        $tracks = $this->getArtistTracks($artist);
        if (!$tracks || $tracks->artist != $artist) {
            abort(404);
        }
        return ($tracks);
    }

    //////// END TRACKS

    /////// ALBUMS
    public function albums(Request $request, $artist, $slug)
    {
        $album = $this->getAlbumWithSlug($slug);
        if (!$album || $album->artist != $artist) {
            abort(404);
        }

        $img = $this->base64_to_image($album->art, storage_path('app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'album' . Str::random() . '.jpg');
        $mainColor = ($img) ? $this->mainColor($img) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($img);

        return view('album', [
            'user' => $request->user(),
            'album' => $album,
            'tracks' => $album->tracks,
            'mainColor' => $mainColor
        ]);
    }

    public function allArtistAlbums (Request $request, $artist)
    {
        $album = $this->getArtistAlbums($artist);
        dd($album);
    }
    /////// END ALBUMS

    ////// ARTIST
    public function artists(Request $request, $name)
    {
        $artist = $this->getArtistWithName($name);
        $album = $artist->albums;
        $track = $artist->tracks;

        $img = $this->base64_to_image($artist->avatar, storage_path('app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'artist' . Str::random() . '.jpg');
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
    public function allArtists(Request $request)
    {
        $paginator = $this->getAllArtists();
        foreach ($paginator as $artist) {
            $artist->mainColor = $this->getColor($artist->avatar);
        }
        return view('allArtist', [
            'paginator' => $paginator,
            'user' => $request->user()
        ]);
    }
    ////// END ARTIST

    public function search(Request $request)
    {
        if (!$request->str) {
            return response()->json();
        }
        return response()->json([
            'result' => $this->queryDB($request->str)
        ]);
    }

    public function browse()
    {
        /*
        $a = Artists::find(rand(1,100));
        $track = $a->tracks()->create([
            'title' => 'Godzilla',
            'slug' => $this->slugUnique('Godzilla'),
            'artist' => $a->name,
            'genre' => 'rap',
            'duration' => 1,
            'url' => '.',
            'art' => 's'
        ]);
        $track->save();
        dd($track->playcount()->create([
            'title' => 'Godzilla',
            'count' => rand(10, 100)
        ]));
        */
        return response('this page is under development');
    }

    public function play(Request $request)
    {
        $type = $request->type;
        $slug = $request->slug;
        return $this->getPlay($type, $slug);
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
