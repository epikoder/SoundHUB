<?php

namespace App\Jobs;

use App\Http\Controllers\MP3File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;

class ProcessUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = array();
    protected $output = array();
    protected $art;

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
        $rand = Str::random();
        $file = 'temp/'.$rand.'.mp3';
        $def = storage_path('/default.png');
        Storage::disk('local')->put($file, Storage::get($this->data['track']));
        if (PHP_OS == 'WINNT') {
            $eyeD3 = new Process(
                [
                    'eyeD3',
                    '-t', $this->data['title'],
                    '-a', $this->data['artist'],
                    '-G', $this->data['genre'],
                    '-A', $this->data['album'],
                    '-c', 'Downloaded at' . env('APP_NAME') . 'com',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . '\app\Console\bin',
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
                    '-c', 'Downloaded at' . env('APP_NAME') . 'com',
                    storage_path('app') . DIRECTORY_SEPARATOR . $file
                ],
                getcwd() . DIRECTORY_SEPARATOR . '/app/Console/usr/bin',
                getenv()
            );
        }
        $eyeD3->run();
        if (!$eyeD3->isSuccessful()) {
            $this->output['eyeD3'] = $eyeD3->getErrorOutput();
        }

        $this->art = 'data:image/webp' . ';base64,' . base64_encode(file_get_contents($def));

        if (isset($this->data['art'])) {
            $image = 'temp/'.$rand.'.jpg';
            Storage::disk('local')->put($image, Storage::get($this->data['art']));
            $type = pathinfo(storage_path('app') . DIRECTORY_SEPARATOR . $image, PATHINFO_EXTENSION);
            $this->art = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(storage_path('app') . DIRECTORY_SEPARATOR . $image));

            if (isset($this->data['append_art'])) {
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
                if (!$eyeD3_image->isSuccessful()) {
                    $this->output['eyeD3_image'] = $eyeD3_image->getErrorOutput();
                }
            }
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
            $duration = substr(MP3File::formatTime(trim($eyeD3_duration->getOutput())).' min', 3);
        }

        Storage::put($this->data['track'], Storage::disk('local')->get($file));
        Storage::disk('local')->delete($file);
        $track = $this->data['user']->tracks()->create([
            'title' => $this->data['title'],
            'artist' => $this->data['artist'],
            'album' => $this->data['album'],
            'genre' => $this->data['genre'],
            'duration' => $duration,
            'url' => $this->data['track'],
            'art' => $this->art,
            'art_url' => $this->data['art']
        ]);
        $track->save();

        DB::table('logs')->insert([
            'name' => 'eyeD3',
            'value' => json_encode($this->output)
        ]);
    }
}
