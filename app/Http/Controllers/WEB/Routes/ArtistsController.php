<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtistsController extends Controller
{
    use MediaQuery;

    public function index(Request $request, $name)
    {
        $user = $request->user();
        if (strtolower(str_replace('%20', ' ', $name)) != strtolower($user->artists->name)) {
            return redirect()->route('login');
        }

        return view('dashboard',[
            'artist' => json_decode($user->artists->toJson()),
            'user' => json_decode($user->toJson())
        ]);
    }

    /**
     * Setup newly created artist  account name
     */
    public function setup(Request $request)
    {
        return view('signup.setup');
    }
    public function setupName(Request $request)
    {
        $name = $this->queryArtist($request->name);
        if (is_object($name)) {
            return response()->json([
                'message' => $request->name . ' already exist'
            ], 400);
        }
        $artist = $request->user()->artists;
        $artist->name = $request->name;
        $artist->save();

        Session::put('init', true);
        return response()->json([
            'url' => route('dashboard/artists', ['name' => $artist->name])
        ]);
    }
    public function queryName(Request $request)
    {
        if(!is_string($request->name)) {
            die;
        }
        $name = $this->queryArtist($request->name);
        if (is_object($name)) {
            return response()->json([
                'message' => $request->name .' already exist'
            ], 203);
        }

        return response()->json([
            'message' => $request->name.' is avialable'
        ]);
    }


    /**
     * Change social links
     */
    public function social(Request $request)
    {
        $artist = $request->user()->artists;
        if ($artist) {
            return redirect()->route('login');
        }
        $social = json_decode($artist->social);
        foreach ($social as $key => $value) {
            $social->$key = $request->$key;
        }
        $artist->social = json_encode($social);
        $artist->save();
        return response()->json();
    }

    public function password(Request $request)
    {
    }

    public function picture(Request $request)
    {
    }
}
