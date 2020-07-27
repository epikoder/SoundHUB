<?php
namespace App\Http\Controllers\API\Media;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait MediaHelper
{
    public function prepare (Request $request)
    {
        if (!$request->exists('title') || !$request->hasFile('track')) {
            dd($request->exists('title'), $request->hasFile('track'));
            return false;
        }

        $data['title'] = $request->title;
        $data['track'] = $request->file('track');
        $data['ext'] = $data['track']->getClientOriginalExtension();
        $data['user'] = $request->user();
        $data['artist'] = $data['user']->artists->name;
        $data['genre'] = $request->genre;
        $data['album'] = env('APP_NAME');
        $data['art'] = '';
        $data['year'] = date('Y');

        if($request->exists('year')) {
            $data['year'] = $request->year;
        }

        if ($request->hasFile('art')) {
            $data['checkbox'] = $request->write;
            $data['art'] = $request->file('art');
            $art = Storage::putFileAs('songs/' . $data['artist'].'/images', $data['art'], $data['title'] . '_' . time() . '.' .$data['art']->getClientOriginalExtension());
            $data['art'] = $art;
        }
        $path = Storage::putFileAs('songs/'.$data['artist'], $data['track'], $data['title'].'_'.time().'.'.$data['ext']);
        $data['track'] = $path;
        return $data;
    }

    public function prepareBulk (Request $request)
    {
    }
}
?>
