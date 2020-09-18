<?php

namespace App\Http\Controllers\ADMIN\Media;

use App\Http\Controllers\Controller;
use App\Jobs\ADMIN\ProcessBulkUpload;
use App\Jobs\ADMIN\ProcessUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class MediaManager extends Controller
{
    use Media;

    public function upload (Request $request)
    {
        $data = $this->save($request);
        if (!$data) {
            return view('Admin.media', [
                'message' => 'Error: Validation failed, try again'
            ]);
        }
        ProcessUpload::dispatch($data);
        return view('Admin.media',[
            'message' => 'upload successful'
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $data = $this->saveBulk($request);
        if (is_string($data)) {
            return response()->json([
                'message' => $data
            ]);
        }

        ProcessBulkUpload::dispatch($data);
        return response()->json(['status'=> 'Upload Successfully']);
    }
}
