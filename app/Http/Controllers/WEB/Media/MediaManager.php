<?php

namespace App\Http\Controllers\WEB\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessUpload;
use App\Tracks;
use Illuminate\Http\Request;

class MediaManager extends Controller
{
    use MediaHelper;

    protected $data = array();
    protected $output = array();

    public function upload(Request $request)
    {
        $data = $this->prepare($request);
        if (!$data) {
            $user = $request->user();
            return view('media.upload', [
                'message' => 'missing some datas',
                ////
                'user' => $user,
                'artist' => $user->artists
            ]);
        }
        ProcessUpload::dispatch($data);
        return view('media.upload', [
            'message' => 'Upload Successfull',
            ////
            'user' => $request->user(),
            'artist' => $request->user()->artists
        ]);
    }

    public function bulkUpload(Request $request)
    {
    }

    public function pla(Request $request)
    {
        $track = Tracks::find(1);
        dd($track);
        $track->year = date('Y');
        $track->save();
    }
}
