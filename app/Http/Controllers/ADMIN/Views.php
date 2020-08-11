<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Views extends Controller
{
    public function index ()
    {
        return view('Admin.login');
    }

    public function dashboard()
    {
        return view('Admin.dashboard');
    }

    public function media()
    {
        return view('Admin.media');
    }

    public function mediaLinks($path)
    {
        $names = DB::table('elite_artist')->get();
        $genres = DB::table('genres')->get();
        switch ($path) {
            case ('home'):
                return view('Admin.include.media.home');
                break;

            case ('upload'):
                return view('Admin.include.media.upload', [
                    'artists' => $names,
                    'genres' => $genres
                ]);
                break;

            case ('al-upload'):
                return view(
                    'Admin.include.media.al-upload',
                    [
                        'artists' => $names,
                        'genres' => $genres
                    ]
                );
                break;

            case ('manage'):
                return view('Admin.include.media.manage');
                break;

            default:
                return view('Admin.login');
        }
    }
}
