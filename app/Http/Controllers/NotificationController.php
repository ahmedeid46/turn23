<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function admin(){
        return view('admin.page.notification');
    }
}
