<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    function showFile($type,$filename){
        $file = Storage::get('public/upload/product/'.$type.'/'.$filename);
        return new Response($file,200);
    }

}
