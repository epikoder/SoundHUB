<?php

namespace App\Http\Controllers\WEB\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBulkUpload;
use App\Jobs\ProcessUpload;
use Illuminate\Http\Request;

class MediaManager extends Controller
{
    use MediaHelper;

    public function upload(Request $request)
    {
        $data = $this->prepare($request);
        if (!$data) {
            $user = $request->user();
            return response()->json([
                'message' => 'Error: Validation failed, try again'
            ], 400);
        }
        ProcessUpload::dispatch($data);
        return response()->json(['message' => 'Successful']);
    }

    public function bulkUpload(Request $request)
    {
        $data = $this->prepareBulk($request);
        if (is_string($data)) {
            return response()->json([
                'message' => $data
            ]);
        }

        ProcessBulkUpload::dispatch($data);
        return response()->json(['message' => 'Upload Successfully']);
    }
}
