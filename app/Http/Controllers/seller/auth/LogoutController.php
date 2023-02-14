<?php

namespace App\Http\Controllers\seller\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //

    function logout(Request $request){
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       return redirect()->route('customer.home');
    }
}
