<?php

namespace App\Http\Controllers\API\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    public function index (Request $request, $name)
    {

        $user = $request->user();
        if (strtolower(str_replace('%20',' ',$name)) != strtolower($user->artists->name)) {
            return view('login');
        }
        return view('dashboard', [
            'user' => $user,
            'artist' => $user->artists
        ]);
    }
    public function uSocial(Request $request)
    {
        $artist = $request->user()->artists;
        if (!$artist) {
            return view('login');
        }
        $social = json_decode($artist->social);
        foreach ($social as $key => $value) {
            $social->$key = $request->$key;
        }
        $artist->social = json_encode($social);
        $artist->save();
        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }
}
