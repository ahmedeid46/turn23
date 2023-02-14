<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeOrder;
use App\Models\HeOrderEquipment;
use App\Models\Service;
use App\Models\SubCat;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;

class HeavyEquipmentsController extends Controller
{
    //
    use UploadFiles;
    function  all(){
        $cats = SubCat::where('cat_id',6)->get();
        return view('admin.page.all-heavy')->with(['cats'=> $cats]);
    }
    function index($id){
        $data['orders'] = HeOrder::with('order_equipments')->where('type',$id)->with('customer')->orderByDesc('id')->get();
        //return $data;
          return view('admin.page.he_orders')->with($data);
    }
    function orderdetails($id){
        $data['order'] = HeOrder::with('customer','order_equipments','order_price')->find($id);
//        return $data;
        return view('admin.page.he_order_details')->with($data);
    }
    function accept(Request $request){
        $item = HeOrder::find($request->order_id);
        $item->status = 1;
        $item->save();
        return redirect()->back();
    }
    function add_price(Request $request){
        $this->validate($request,[
            'order_id' =>'required',
            'docs' => 'required',
            'photos'=>'required',
        ]);
        $order = HeOrder::find($request->order_id);
        $order->docs = $this->orderUploadmultiFile('equipment',$request->docs,'equipment_docs');
        $order->photos = $this->orderUploadmultiFile('equipment',$request->photos,'equipment_photos');
        $order->status = 2;
        foreach($request->price as $key => $price){
            $equipment = HeOrderEquipment::find($key);
            $equipment->price = $price;
            $equipment->save();
        }
        $order->save();


        return redirect()->back();
    }
}
