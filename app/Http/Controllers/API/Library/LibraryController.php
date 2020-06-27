<?php

namespace App\Http\Controllers\API\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\Library\Helpers;

class LibraryController extends Controller
{
    use Helpers;

    public function songs ()
    {
        $this->songsList();
    }
}
