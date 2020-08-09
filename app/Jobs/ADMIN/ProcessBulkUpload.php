<?php

namespace App\Jobs\ADMIN;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;

class ProcessBulkUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = array();

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
        /// USER SOUNDHUB
        $user = User::find(1);
        $album = $user->albums()->create([
            'title' => $this->data['title'],
            'artist' => $this->data['album_artist'],
            'genre' => $this->data['genre'],
            'track_num' => $this->data['num'],
        ]);
        $album->save();

        for ($a = 1; $a <= $this->data['num']; $a++) {
            $file = 'temp/' . Str::random() . 'mp3';
            Storage::disk('local')->put($file, Storage::get($this->data['tracks'][$a]['track']));

            if (PHP_OS == 'WINNT') {
                $eyeD3 = new Process(
                    [
                        'eyeD3',
                        '-t', $this->data['tracks'][$a]['title'],
                        '-a', $this->data['tracks'][$a]['artist'],
                        '-b', $this->data['album_artist'],
                        '-n', $a,
                        '-A', $this->data['title'],
                        '-G', $this->data['genre'],
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
                        '-t', $this->data['tracks'][$a]['title'],
                        '-a', $this->data['tracks'][$a]['artist'],
                        '-b', $this->data['album_artist'],
                        '-n', $a,
                        '-A', $this->data['title'],
                        '-G', $this->data['genre'],
                        '-c', 'Downloaded at' . env('APP_NAME') . 'com',
                        storage_path('app') . DIRECTORY_SEPARATOR . $file
                    ],
                    getcwd() . DIRECTORY_SEPARATOR . '../app/Console/usr/bin',
                    getenv()
                );
            }
            $eyeD3->run();
            if (!$eyeD3->isSuccessful()) {
                $this->output['eyeD3'][$a] = $eyeD3->getErrorOutput();
            }


            if (isset($this->data['art'])) {
                $image = 'temp/' . Str::random() . '.img';
                Storage::disk('local')->put($image, Storage::get($this->data['art']));
                if (PHP_OS == 'WINNT') {
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
                } else {
                    $eyeD3_image = new Process(
                        [
                            'eyeD3',
                            '--add-images',
                            storage_path('app') . DIRECTORY_SEPARATOR . $image . ':FRONT_COVER',
                            storage_path('app') . DIRECTORY_SEPARATOR . $file
                        ],
                        getcwd() . '/../app/Console/usr/bin',
                        getenv()
                    );
                }

                $eyeD3_image->run();
                if (!$eyeD3_image->isSuccessful()) {
                    $this->output['eyeD3_image'][$a] = $eyeD3_image->getErrorOutput();
                }
                Storage::disk('local')->delete($image);
            }

            Storage::put($this->data['tracks'][$a]['track'], Storage::disk('local')->get($file));
            Storage::disk('local')->delete($file);
            $album->tracks()->create([
                'title' => $this->data['tracks'][$a]['title'] . $this->data['tracks'][$a]['feat'],
                'artist' => $this->data['tracks'][$a]['artist'],
                'genre' => $this->data['genre'],
                'url' => $this->data['tracks'][$a]['track'],
                'art' => $this->data['art'],
                'admin' => $this->data['admin']
            ]);
        }
        DB::table('logs')->insert([
            'name' => 'eyeD3',
            'value' => json_encode($this->output)
        ]);
    }
}
