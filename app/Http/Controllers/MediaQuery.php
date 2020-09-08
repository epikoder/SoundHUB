<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Artists;
use App\Models\EliteArtists;
use App\Models\Tracks;
use App\User;
use Illuminate\Support\Facades\DB;
use League\ColorExtractor\Color;
use League\ColorExtractor\Palette;
use Symfony\Component\Process\Process;

trait MediaQuery
{
    /**
     * Get All tracks from Database
     *
     * @param int $count
     */
    public function getAllTracks($count = 20)
    {
        $DBtracks = Tracks::all();
        $tracks = array();
        foreach ($DBtracks as $track => $val) {
            if ($track >= $count) {
                break;
            }
            $tracks[$track] = $val;
        }
        shuffle($tracks);
        return $tracks;
    }

    /**
     * Get All Albums from Database
     *
     * @param int $count
     */
    public function getAllAlbums($count = 20)
    {
        $DBAlbums = Albums::all();
        $albums = array();
        foreach ($DBAlbums as $album => $val) {
            if ($album >= $count) {
                break;
            }
            $albums[$album] = $val;
        }
        shuffle($albums);
        return $albums;
    }

    /**
     * Get Most Downloaded from Most Downloaded table
     *
     * @param int $count
     */
    public function mostDownloaded($count = 20)
    {
        $md = array();
        $x = 0;
        $DBmd = DB::table('download_counter')->get();
        foreach ($DBmd as $DB) {
            if ($x >= $count) {
                break;
            }
            $x++;
            $track = Tracks::find($DB->tracks_id);
            $md[$x] = $track;
        }
        return $md;
    }

    /**
     * Get Trending from Database
     *
     * @param array $count[$track, $album]
     */
    public function trend($count = [15, 15])
    {
        $a = 0;
        $single_tracks = Tracks::where('trackable_type', 'App\User')->get();
        $single_tracks = $single_tracks->shuffle();
        $trend = array();
        foreach ($single_tracks as $single) {
            if ($single->art_url) {
                if ($a >= $count[0]) {
                    break;
                }
                $a++;
                $trend[$a] = $single;
            }
        }

        // Albums
        $albums = Albums::all();
        $albums = $albums->shuffle();
        foreach ($albums as $album) {
            if ($album->art_url) {
                if ($a >= ($count[1] + $count[0])) {
                    break;
                }
                $a++;
                $trend[$a] = $album;
            }
        }
        shuffle($trend);
        return $trend;
    }

    /**
     * Get Album from Database
     *
     * @param int $id
     */
    public function getAlbum(int $id)
    {
        return Albums::find($id);
    }

    /**
     * Get Track From Database
     *
     * @param int $id
     */
    public function getTrack(int $id)
    {
        return Tracks::find($id);
    }

    /**
     * Get User
     *
     * @param int $id
     */
    public function getUserWithId(int $id)
    {
        return User::find($id);
    }

    /**
     * Get User from Database
     *
     * @param string $type $type ['App/User']
     * @param int $id
     */
    public function getUser(string $type, int $id)
    {
        if (PHP_OS == 'WINNT') {
            $type = explode('\\', $type);
        } else {
            $type = explode('/', $type);
        }

        if ($type[1] == 'Albums') {
            $album = Albums::find($id);
            return $this->getUserWithId($album->user_id);
        } elseif ($type[1] == 'User') {
            return $this->getUserWithId($id);
        }

        return false;
    }

    /**
     * Get MainColor from image
     */
    public function mainColor($img, $bool = true, $palette = [16, 8])
    {
        if (!$img)
            return false;

        $mime = explode('/', mime_content_type($img));
        switch ($mime[1]) {
            case 'jpeg':
                $image = imagecreatefromjpeg($img);
                break;

            case 'webp':
                $image = imagecreatefromwebp($img);
                break;
            case 'bmp':
                $image = imagecreatefrombmp($img);
                break;

            case 'png':
                $image = imagecreatefrompng($img);
                break;

            default:
                return false;
                break;
        }
        $imgsize = getimagesize($img);
        $resizeImage = imagecreatetruecolor($palette[0], $palette[1]);
        imagecopyresized($resizeImage, $image, 0, 0, 0, 0, $palette[0], $palette[1], $imgsize[0], $imgsize[1]);
        imagedestroy($image);

        $colors = [];

        for ($i = 0; $i < $palette[1]; $i++) {
            for ($j = 0; $j < $palette[0]; $j++) {
                $colors[] = '#' . dechex(imagecolorat($resizeImage, $j, $i));
            }
        }

        imagedestroy($resizeImage);
        $colors = array_unique($colors);
        $mainColor = array();
        $a = 0;
        foreach ($colors as $color => $value) {
            $mainColor[$a] = $value;
            $a++;
        }
        if ($bool) {
            $this->invert($mainColor);
        }

        return $mainColor;
    }

    /**
     * Invert Color if mainColor[0] is close
     * to white
     *
     * @param array &$array
     *
     * @see MediaQuery::mainColor
     */
    public function invert(array &$colors)
    {
        list($r, $g, $b) = sscanf($colors[0], "#%02x%02x%02x");
        $value = (max($r, $g, $b) + min($r, $g, $b)) / 510.0;
        if ($value >= 0.8) {
            $colors[0] = 'rgb(13, 22, 29)';
            $colors[1] = 'rgb(16, 3, 19)';
        }
    }

    /**
     * @param [string] $img
     * @return bool|string
     */
    static public function base64_to_image(string $base64,string $img)
    {
        if (!$base64) {
            return false;
        }
        $file = fopen($img, 'wb');

        // split base64 to data[]
        $data = explode(',', $base64);
        if (count($data) > 2) {
            return false;
        }
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        return $img;
    }

    static public function image_to_base64(string $path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path));
    }

    public function removeFile($file)
    {
        if (PHP_OS == 'WINNT') {
            $rm = new Process([
                'C:\cygwin64\bin\rm', $file,
            ]);
        } else {
            $rm = new Process([
                '/bin/rm', $file,
            ]);
        }

        $rm->run();
        if (!$rm->isSuccessful()) {
            return $rm->getErrorOutput();
        }
        return $rm->getOutput();
    }

    /**
     * Generate default avatar for artist
     */
    public function artistArt($path = null)
    {
        $path = $path ? $path : storage_path('avatar.png');
        return $this->image_to_base64($path);
    }

    /**
     * Get free Artist name
     */
    public function queryArtist(string $string)
    {
        $pa = Artists::where('name', $string)->first();
        $ea = EliteArtists::where('name', $string)->first();

        return ($ea ? $ea : $pa);
    }
}
