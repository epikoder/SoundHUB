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


    protected $output = array();

    public function upload (Request $request)
    {
        $data = $this->save($request);
        if (!$data) {
            return view('Admin.media', [
                'error' => 'not successful'
            ]);
        }
        ProcessUpload::dispatch($data);
        return view('Admin.media',[
            'status' => 'upload successful'
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $data = $this->saveBulk($request);
        if (!$data) {
            return response()->json([
                'error' => 'not successful'
            ]);
        }

        ProcessBulkUpload::dispatch($data);
        return response()->json(['status'=> 'Upload Successfully']);
    }
}
