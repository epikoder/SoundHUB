<?php

namespace App\Http\Controllers\WEB\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBulkUpload;
use App\Jobs\ProcessUpload;
use Illuminate\Http\Request;

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
            return response()->json([
                'message' => 'Error: cross check form and try again'
            ], 400);
        }
        ProcessUpload::dispatch($data);
        return response()->json(['message' => 'Successful']);
    }

    public function bulkUpload(Request $request)
    {
        $data = $this->prepareBulk($request);
        if (!$data) {
            return response()->json([
                'message' => 'not successful'
            ]);
        }

        ProcessBulkUpload::dispatch($data);
        return response()->json(['message' => 'Upload Successfully']);
    }

    public function downloadAlbum(Request $request, $type, $artist, $id, $album)
    {

    }
}
