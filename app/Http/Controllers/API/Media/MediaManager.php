<?php

namespace App\Http\Controllers\API\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class MediaManager extends Controller
{
    use MediaHelper;

    protected $data = array();

    public function upload (Request $request)
    {
        $data = $this->prepare($request);
        if (!$data) {
            return response()->json([], 400);
        }
        if (PHP_OS == 'WINNT') {
            $id3 = new Process([
                'C:\Users\efedu\LabCodes\SoundHUB\api\app\Console\bin\id3.exe',
                '-t', $data['title'],
                '-a', $data['artist'],
                '-A', $data['album'],
                '-g', $data['genre'],
                '-y', $data['year'],
                $data['path']

            ]);
        } else {
            $id3 = new Process([
                '~/usr/bin/id3tag',
                '-t', $data['title'],
                '-a', $data['artist'],
                '-A', $data['album'],
                '-g', $data['genre'],
                '-y', $data['year'],
                $data['path']
            ]);
        }
        $id3->run();
        $track = $data['user']->tracks()->create([
            'title' => $data['title'],
            'artist' => $data['artist'],
            'album' => $data['album'],
            'genre' => $data['genre'],
            'year' =>$data['year']
        ]);
        $track->save();
        return response()->json();
    }

    public function bulkUpload (Request $request)
    {

    }
}
