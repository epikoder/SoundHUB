<?php

namespace App\Jobs;

use App\Http\Controllers\MP3File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ProcessBulkUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = array();
    protected $art;
    protected $album;
    protected $total_duration = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $def = storage_path('/default.png');
        $type = pathinfo($def, PATHINFO_EXTENSION);
        $this->art = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($def));
        if (isset($this->data['art'])) {
            $image = 'temp/' . Str::random() . '.jpg';
            Storage::disk('local')->put($image, Storage::get($this->data['art']));
            $this->art = 'data:image/webp' . ';base64,' . base64_encode(file_get_contents(storage_path('app') . DIRECTORY_SEPARATOR . $image));
        }

        $album = $this->data['artist']->albums()->create([
            'title' => $this->data['title'],
            'slug' => $this->data['slug'],
            'artist' => $this->data['artist']->name,
            'genre' => $this->data['genre'],
            'track_num' => $this->data['num'],
            'art' => $this->art,
            'art_url' => $this->data['art']
        ]);
        $album->save();
        $this->album = $album;

        for ($a = 1; $a <= $this->data['num']; $a++) {
            $rand = Str::random();
            $file = 'temp/' . $rand . '.mp3';
            Storage::disk('local')->put($file, Storage::get($this->data['tracks']->$a->track));

            if (PHP_OS == 'WINNT') {
                $eyeD3 = new Process(
                    [
                        'eyeD3',
                        '-t', $this->data['tracks']->$a->title,
                        '-a', $this->data['artist']->name . $this->data['tracks']->$a->feat,
                        '-b', $this->data['artist']->name,
                        '-n', $a,
                        '-A', $this->data['title'],
                        '-G', $this->data['genre'],
                        '-c', 'Downloaded at' . Config::get('app.name') . 'com',
                        storage_path('app') . DIRECTORY_SEPARATOR . $file
                    ],
                    getcwd() . '\app\Console\bin',
                    getenv()
                );
            } else {
                $eyeD3 = new Process(
                    [
                        'eyeD3',
                        '-t', $this->data['tracks']->$a->title,
                        '-a', $this->data['artist']->name . $this->data['tracks']->$a->feat,
                        '-b', $this->data['artist']->name,
                        '-n', $a,
                        '-A', $this->data['title'],
                        '-G', $this->data['genre'],
                        '-c', 'Downloaded at' . Config::get('app.name') . 'com',
                        storage_path('app') . DIRECTORY_SEPARATOR . $file
                    ],
                    getcwd() . DIRECTORY_SEPARATOR . '/app/Console/usr/bin',
                    getenv()
                );
            }
            $eyeD3->run();

            if (isset($this->data['append_art'])) {
                $image = 'temp/' . $rand . '.img';
                Storage::disk('local')->put($image, Storage::get($this->data['art']));
                if (PHP_OS == 'WINNT') {
                    $eyeD3_image = new Process(
                        [
                            'eyeD3',
                            '--add-image',
                            str_replace('C:', 'C\:', storage_path('app') . DIRECTORY_SEPARATOR . $image) . ':FRONT_COVER',
                            storage_path('app') . DIRECTORY_SEPARATOR . $file
                        ],
                        getcwd() . '\app\Console\bin',
                        getenv()
                    );
                } else {
                    $eyeD3_image = new Process(
                        [
                            'eyeD3',
                            '--add-image',
                            storage_path('app') . DIRECTORY_SEPARATOR . $image . ':FRONT_COVER',
                            storage_path('app') . DIRECTORY_SEPARATOR . $file
                        ],
                        getcwd() . '/app/Console/usr/bin',
                        getenv()
                    );
                }

                $eyeD3_image->run();
                Storage::disk('local')->delete($image);
            }

            $eyeD3_duration = new Process(
                [
                    'python',
                    'mp3_lenght.py',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . '\app\Console\bin',
                getenv()
            );
            $eyeD3_duration->run();
            $duration = null;
            if ($eyeD3_duration->isSuccessful()) {
                $this->total_duration += trim($eyeD3_duration->getOutput());
                $duration = substr(MP3File::formatTime(trim($eyeD3_duration->getOutput())) . ' min', 3);
            }


            Storage::put($this->data['tracks']->$a->track, Storage::disk('local')->get($file));
            Storage::disk('local')->delete($file);
            $album->tracks()->create([
                'title' => $this->data['tracks']->$a->title . $this->data['tracks']->$a->feat,
                'slug' => $this->data['tracks']->$a->slug,
                'artist' => $this->data['tracks']->$a->artist,
                'album_id' => $album->id,
                'genre' => $this->data['genre'],
                'duration' => $duration,
                'url' => $this->data['tracks']->$a->track,
                'art_url' => $this->data['art'],
                'art' => $this->art
            ]);
        }
        if ($this->total_duration) {
            $album->duration = MP3File::formatTime($this->total_duration) . ' min';
            $album->save();
        }
    }

    /**
     * On job failed
     */
    public function failed()
    {
        for ($a = 1; $a <= $this->data['num']; $a++) {
            Storage::delete($this->data['tracks']->$a->track);
        }
        $this->album->delete();
    }
}
