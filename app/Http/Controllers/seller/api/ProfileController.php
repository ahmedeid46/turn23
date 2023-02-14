<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    function avtar($filename){
        return Storage::download('/public/upload/seller/avtar/'.$filename);
    }
    function file($folder,$filename){
        return Storage::download('/public/upload/seller/'.$folder.'/'.$filename);
    }
}
