<?php

namespace App\Http\Controllers\Customer\auth;

use App\Http\Controllers\Controller;
use App\Traits\NavBar;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/';
    use NavBar;
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:customer');
    }
    // section show register
    public function showLogin()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('customer.auth.login')->with($data);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }
        return redirect()->back()->withErrors('message','Login details are not valid');
    }

}
