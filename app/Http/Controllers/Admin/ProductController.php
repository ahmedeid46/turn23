<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function delete(Request $request){
        try {
            $row = Product::find($request->id);
            $row->delete();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    public function show($id){
        $data['product'] = Product::firstWhere('id',$id);
        return view('admin.page.product')->with($data);
    }
}
