<?php
namespace App\Http\Controllers\API\Library;

use App\Models\Products\Albums;
use App\Models\Products\Songs;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class Helpers
{
    public function getSongs ()
    {
        return  Songs::find($this->id);
    }

    public function getAlbums ()
    {
        return Albums::find($this->id);
    }

    public function getArtistInfo ()
    {
        return User::find($this->id);
    }

    public function putSongs ()
    {
        if ($this->request->exists('feat')) {
            $feat = ' feat. '.$this->request->feat;
        }
        $this->song->title = $this->request->title.$feat;
        $this->song->artist =  $this->request->user()->name;
        $file = $this->request->file('song');
        $ext = $file->getClientOriginalExtension();
        $path = Storage::disk(env('DISK'))->putFileAs('public/'.$this->song->artist, $file, $this->song->title.'.'.$ext);
        $this->song->url = $path;
        $this->song->save();
        if (PHP_OS == 'WINNT') {
            $id3 = new Process([
                'C:\Users\efedu\LabCodes\SoundHUB\app\Console\id3.exe',
                '-t', $this->song->title,
                '-a', $this->song->artist,
                $path

            ]);
        } else {
            $id3 = new Process([
                '~/usr/bin/id3tag',
                '-t', $this->song->title,
                '-a', $this->song->artist,
                $path

            ]);
        }
        $id3->run();
    }

    public function putAlbum ()
    {

    }

    public function saveFile ()
    {

    }
}
?>
