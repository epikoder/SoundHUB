<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaQuery;
use App\Http\Controllers\WEB\Auth\AuthFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtistsController extends Controller
{
    use MediaQuery, AuthFacade;

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
        if ($request->user()->artist->name) {
            return redirect()->route('dashboard/artists');
        }
        return view('signup.setup');
    }
    public function setupName(Request $request)
    {
        if ($request->user()->artist->name) {
            return redirect()->route('dashboard/artists');
        }

        $query = $this->queryArtist();
        $name = $query->where('name', $request->name)->first();
        if ($name) {
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
        $query = $this->queryArtist();
        $name = $query->where('name', $request->name)->first();
        if ($name) {
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
        $data = $this->auth($request, $request->oldPassword);
        if (!$data) {
            return response()->json([
                'message' => 'wrong password'
            ], 400);
        }

        if (strlen($request->password) <= 7) {
            return response()->json([
                'message' => 'password too short'
            ], 400);
        }

        $data['user']->password = bcrypt($request->password);
        $data['user']->save();
        $this->lazyAuth($data['user']);

        return response()->json([
            'message' => 'Successful'
        ]);
    }

    public function picture(Request $request)
    {
        $artist = ($request->user())->artists;
        $path = $this->putFile($request->file('art'));
        $artist->avatar = $this->image_to_base64($path);
        $artist->save();
        $this->removeFile($path);

        return response()->json([
            'message' => 'Successful'
        ]);
    }
}
