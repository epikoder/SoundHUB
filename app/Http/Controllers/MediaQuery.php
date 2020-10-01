<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Artists;
use App\Models\EliteArtists;
use App\Models\PlayCount;
use App\Models\Tracks;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

trait MediaQuery
{
    /**
     * Get All tracks from Database
     *
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function getNewTracks( $count = 20)
    {
        return DB::table('tracks')->take(10)->get()->sortByDesc('created_at');
    }
    public function getArtistTracks($artist)
    {
        return Tracks::where('artist', $artist)->simplePaginate(50);
    }
    public function getTrackWithSlug(string $slug)
    {
        return Tracks::where('slug', $slug)->first();
    }


    /**
     * Albums
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllAlbums()
    {
        /*
        $artist = EliteArtists::find(1);
        $artist->albums()->create([
            'title' => 'Strings and Blinks',
            'slug' => $this->slugUnique('Strings and Blinks', '\App\Models\Albums'),
            'artist' => $artist->name,
            'genre' => 'Rap',
            'url' => 'l',
            'track_num' => rand(2, 10),
            'art' => 's'
        ]);
        //*/
        return Albums::simplePaginate(50);
    }
    public function getArtistAlbums($artist)
    {
        return Albums::where('artist', $artist)->simplePaginate(50);
    }
    public function getAlbumWithSlug(string $slug)
    {
        return Albums::where('slug', $slug)->first();
    }


    /**
     * Artist
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllArtists()
    {
        return $this->queryArtist()->paginate(50);
    }

    /**
     * @return \App\Models\Artists|\App\Models\EliteArtists
     */
    public function getArtistWithName(string $string)
    {
        $artist = Artists::where('name', $string)->first();
        return $artist ? Artists::where('name', $string)->first() : EliteArtists::where('name', $string)->first();
    }

    ////
    //// Library
    ////
    /**
     * @return \Illuminate\Support\Collection
     */
    public function trending ($count = 25)
    {
        $trend = PlayCount::get()->sortByDesc('count')->take($count);
        return $trend;
    }

    public function getPlay (string $type,string $slug)
    {
        if ($type === 'track') {
            $a = Tracks::where('slug', $slug)->first();
            $a->url = Storage::url('songs/godzilla.mp3');
            $a->color = $this->getColor($a->art);
            return [$a];
        }
    }

    ///
    /// Queries
    ///
    public function queryDB (string $string)
    {
        $artist = $this->queryArtist()->where('name', 'LIKE', '%'.$this->escape_like($string).'%')->get();
        foreach ($artist as $key)
        {
            $key->url = route('artist', ['name' => $key->name]);
        }

        $media = $this->queryMedia()->where('title', 'LIKE', '%'.$this->escape_like($string).'%')->get();
        foreach ($media as $key)
        {
            if ($key->type == 'track') {
                $key->url = route('track', ['artist' => $key->artist, 'slug' => $key->slug]);
            } else {
                $key->url = route('album', ['artist' => $key->artist, 'slug' => $key->slug]);
            }
        }
        return [
            'artist' => $artist,
            'media' => $media
        ];
    }

    /**
     * Query Artist
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function queryArtist()
    {
        $artist = DB::table('artists')->select('name', 'avatar');
        $elite = DB::table('elite_artist')->select('name', 'avatar');
        $query = $elite->union($artist);
        $querySql = $query->toSql();
        $query = DB::table(DB::raw("($querySql order by name desc) as a"))->mergeBindings($query);
        return $query;
    }

    /**
     * Query Tracks AND Albums
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function queryMedia()
    {
        $tracks = DB::table('tracks')->select('title', 'slug','artist', 'type');
        $albums = DB::table('albums')->select('title', 'slug','artist', 'type');
        $query = $albums->union($tracks);
        $querySql = $query->toSql();
        $query = DB::table(DB::raw("($querySql order by type asc) as a"))->mergeBindings($query);
        return $query;
    }


    //////////////////////////
    //////////////////////////
    //////////////////////////
    /**
     * Get MainColor from image
     * @param string $img_path
     * @return array $mainColor
     */
    public function mainColor($img_path, $bool = true, $palette = [16, 8])
    {
        if (!$img_path)
            return false;

        $mime = explode('/', mime_content_type($img_path));
        switch ($mime[1]) {
            case 'jpeg':
                $image = imagecreatefromjpeg($img_path);
                break;

            case 'webp':
                $image = imagecreatefromwebp($img_path);
                break;
            case 'bmp':
                $image = imagecreatefrombmp($img_path);
                break;

            case 'png':
                $image = imagecreatefrompng($img_path);
                break;

            default:
                return false;
                break;
        }
        $imgsize = getimagesize($img_path);
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
     * Invert Color if colors[0] is close
     * to white
     *
     * @param array &$colors
     *
     * @see MediaQuery::mainColor
     */
    public function invert(&$colors)
    {
        list($r, $g, $b) = sscanf($colors[0], "#%02x%02x%02x");
        $value = (max($r, $g, $b) + min($r, $g, $b)) / 510.0;
        if ($value >= 0.8) {
            $colors[0] = 'rgb(13, 22, 29)';
            $colors[1] = 'rgb(16, 3, 19)';
        }
    }

    /**
     * @param [string] $img_path
     * @return bool|string
     */
    static public function base64_to_image(string $base64, string $img_path)
    {
        if (!$base64 || !$img_path) {
            return false;
        }
        $file = fopen($img_path, 'wb');

        // split base64 to data[]
        $data = explode(',', $base64);
        $offset = count($data) - 1;
        if ($offset < 1) {
            return false;
        }
        fwrite($file, base64_decode($data[$offset]));
        fclose($file);
        return $img_path;
    }

    static public function image_to_base64(string $path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path));
    }

    public static function removeFile(string $file)
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
    public function artistArt($path = null) : string
    {
        $path = $path ? $path : storage_path('avatar.png');
        return $this->image_to_base64($path);
    }
    public static function coverArt(string $path = null) : string
    {
        $def = $path ? $path : storage_path('/default.png');
        $type = pathinfo($def, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($def));
    }

    public function putFile($file, $path = 'images')
    {
        return Storage::putFile($path, $file);
    }

    /**
     * Generate unique slug
     *
     * @param string $string
     * @param \App\Models\Albums|\App\Models\Tracks $class
     */
    public static function slugUnique(string $string, $class = '\App\Models\Tracks') : string
    {
        $obj = $class::where('slug', $string)->first();
        if ($obj) {
            $slug = $string;
            $x = 1;
            do {
                $string = $slug . '-' . $x++;
            } while ($class::where('slug', $string)->first());
        }
        return $string;
    }

    public function getColor($base64, $_path = null) : array
    {
        $path = $_path ? $_path : storage_path('app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'artist' . Str::random() . '.jpg';
        $this->base64_to_image($base64, $path);
        $color = ($path) ? $this->mainColor($path, false) : ['rgb(13, 22, 29)', 'rgb(16, 3, 19)'];
        $this->removeFile($path);
        return $color;
    }

    /**
     * Escape special character for LIKE query
     */
    public function escape_like(string $string, string $char = '\\') : string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $string
        );
    }
}

