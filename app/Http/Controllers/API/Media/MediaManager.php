<?php

namespace App\Http\Controllers\API\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessUpload;
use App\Tracks;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class MediaManager extends Controller
{
    use MediaHelper;

    protected $data = array();
    protected $output = array();

    public function upload (Request $request)
    {
        $data = $this->prepare($request);
        if (!$data) {
            return view('media.upload', [
                'message' => 'missing some datas'
            ]);
        }
        ProcessUpload::dispatch($data);
        return view('media.upload', [
                'message' => 'Upload Successfull'
            ]);
    }

    public function bulkUpload (Request $request)
    {

    }

    public function pla (Request $request)
    {
        $track = Tracks::find(1);
        dd($track);
        $track->year = date('Y');
        $track->save();
    }
}
