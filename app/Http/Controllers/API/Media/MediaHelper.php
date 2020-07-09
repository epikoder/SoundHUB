<?php
namespace App\Http\Controllers\API\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait MediaHelper
{
    public function prepare (Request $request)
    {
        if (!$request->exists('title') || !$request->hasFile('track')) {
            return false;
        }
        $data['title'] = $request->title;
        $data['track'] = $request->file('track');
        $data['ext'] = $data['track']->getClientOriginalExtension();
        $data['user'] = $request->user();
        $data['artist'] = $data['user']->artists->name;
        $data['genre'] = $request->genre;
        $data['album'] = $request->album;
        $data['year'] = $request->year;

        $path = Storage::disk(env('APP_DISK', 'local'))
        ->putFileAs(env('APP_MEDIA_DIR') . $data['artist'], $data['track'], $data['title'].'-'.time().'.' . $data['ext']);
        unset($data['track']);
        $data['path'] = storage_path('app') . DIRECTORY_SEPARATOR . $path;
        return $data;
    }

    public function prepareBulk (Request $request)
    {
    }
}
?>
