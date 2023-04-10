<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    
    public function download($filename) {
        return Storage::disk('files')->download($filename);

    }

}
