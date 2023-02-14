<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Trining;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //
    function index(){
        return view('seller.page.index-training');
    }
    function request(){
        $data['trainings'] = Trining::where('seller_id',auth('seller')->user()->getAuthIdentifier())->where('status','!=',0)->where('status','!=',-1)->with('customer')->get();
        return view('seller.page.training')->with($data);
    }
    function accept(Request $request){
        $request->validate([
            'training_id'=>'required|exists:training,id'
        ]);
        $row =Trining::find($request->training_id);
        $row->status = 1;
        $row->save();
        return redirect()->back()->with('successful','Accepted Successfully');
    }
    function decline(Request $request){
        $request->validate([
            'training_id'=>'required|exists:training,id'
        ]);
        $row =Trining::find($request->training_id);
        $row->status = -2;
        $row->save();
        return redirect()->back()->with('successful','Accepted Successfully');
    }
}
