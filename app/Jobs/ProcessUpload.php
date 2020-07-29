<?php

namespace App\Jobs;

use App\Tracks;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class ProcessUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = array();
    protected $output = array();

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
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
        $file = 'temp/music.mp3';
        Storage::disk('local')->put($file, Storage::get($this->data['track']));
        if (PHP_OS == 'WINNT') {
            $eyeD3 = new Process(
                [
                    'eyeD3',
                    '-t', $this->data['title'],
                    '-a', $this->data['artist'],
                    '-G', $this->data['genre'],
                    '-A', $this->data['album'],
                    '-Y', $this->data['year'],
                    '-c', 'Downloaded at' . env('APP_NAME') . 'com',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . '\..\app\Console\bin',
                getenv()
            );
        } else {
            $eyeD3 = new Process(
                [
                    'eyeD3',
                    '-t', $this->data['title'],
                    '-a', $this->data['artist'],
                    '-G', $this->data['genre'],
                    '-A', $this->data['album'],
                    '-Y', $this->data['year'],
                    '-c', 'Downloaded at' . env('APP_NAME') . 'com',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . DIRECTORY_SEPARATOR . '../app/Console/usr/bin',
                getenv()
            );
        }
        $eyeD3->run();
        if (!$eyeD3->isSuccessful()) {
            $this->output['eyeD3'] = $eyeD3->getErrorOutput();
        }

        if (isset($this->data['checkbox'])) {
            $image = 'temp/image.jpg';
            Storage::disk('local')->put($image, Storage::get($this->data['art']));
            $eyeD3_image = new Process(
                [
                    'eyeD3',
                    '--add-images',
                    storage_path('app') . DIRECTORY_SEPARATOR . $image . ':FRONT_COVER',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . '\..\app\Console\bin',
                getenv()
            );
            $eyeD3_image->run();
            if (!$eyeD3_image->isSuccessful()) {
                $this->output['eyeD3_image'] = $eyeD3_image->getErrorOutput();
            }
            Storage::put($this->data['track'], Storage::disk('local')->get($file));
            Storage::disk('local')->delete($image);
        }
        Storage::disk('local')->delete($file);
        $track = $this->data['user']->tracks()->create([
            'title' => $this->data['title'],
            'artist' => $this->data['artist'],
            'album' => $this->data['album'],
            'genre' => $this->data['genre'],
            'year' => $this->data['year'],
            'url' => $this->data['track'],
            'art' => $this->data['art']
        ]);
        $track->save();

        DB::table('logs')->insert([
            'name' => 'eyeD3',
            'value' => json_encode($this->output)
        ]);
    }

    public function failed ()
    {
        dd($this->output);
    }
}
