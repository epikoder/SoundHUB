<?php

namespace App\Http\Controllers\WEB\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBulkUpload;
use App\Jobs\ProcessUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;

class MediaManager extends Controller
{
    use MediaHelper;

    protected $data = array();
    protected $output = array();

    public function upload(Request $request)
    {
        $data = $this->prepare($request);
        if (!$data) {
            $user = $request->user();
            return view('media.upload', [
                'message' => 'missing some datas',
                'user' => $user,
                'artist' => $user->artists
            ]);
        }
        ProcessUpload::dispatch($data);
        return view('media.upload', [
            'message' => 'Upload Successfull',
            'user' => $request->user(),
            'artist' => $request->user()->artists
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $data = $this->prepareBulk($request);
        if (!$data) {
            return response()->json([
                'error' => 'not successful'
            ]);
        }

        ProcessBulkUpload::dispatch($data);
        return response()->json(['status' => 'Upload Successfully']);
    }
}
