<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\Concerns\Has;
use phpseclib3\Crypt\Hash;

class ProfileController extends Controller
{
    //
    function index(){
        $data['user'] = auth('admin')->user();
        return view('admin.page.profile')->with($data);
    }
    function settingShow(){
        $data['user'] = auth('admin')->user();
        return view('admin.page.setting')->with($data);
    }
    function setting(Request $request){
        $this->validate($request, [
            'name' =>'required',
            'img' =>'image',
            'email' => 'required|email',
            'password' =>'confirmed',
        ]);
        try {
            $admin = Admin::find(auth('admin')->user()->getAuthIdentifier());
            $admin->name = $request->name;
            $admin->email = $request->email;
            if ($request->password !=null){
                $admin->password = Hash::make($request->password);
            }
            if ($request->hasFile('img')){
                // Get filename with the extension
                $filenameWithExt = $request->img->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->img->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $request->name . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->img->storeAs('public/upload/admin/avtar', $fileNameToStore);
                $admin->img = 'public/upload/admin/avtar/'.$fileNameToStore;
            }
            $admin->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();

        }


    }
    function file($filename){
        $file = Storage::get(decrypt($filename));
        return new Response($file, 200);
    }
    function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.show.login');
    }
}
