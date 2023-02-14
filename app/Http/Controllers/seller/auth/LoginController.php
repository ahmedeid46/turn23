<?php

namespace App\Http\Controllers\seller\auth;

use App\Http\Controllers\Controller;
use App\Traits\NavBar;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use NavBar;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:seller');
    }
    // section show register
    public function showLogin()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('seller.auth.login')->with($data);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:sellers',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('seller')->attempt($credentials)) {
            return redirect()->route('seller.chemical')
                ->withSuccess('Signed in');
        }
        return redirect()->back()->withErrors('Login details are not valid');
    }

}
