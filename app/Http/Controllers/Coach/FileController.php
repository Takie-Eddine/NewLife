<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(){


    }


    public function download($id){
        $file = File::findOrFail($id);

        return response()->download(public_path('images/files/'.$file->name));
    }
}
