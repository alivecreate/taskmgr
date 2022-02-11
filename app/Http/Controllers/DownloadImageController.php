<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadImageController extends Controller
{
    
    public function download($file){
     return response()->download(public_path("/web/files/{$file}"));
 }
}
