<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Trining;
use App\Traits\NavBar;
use Hashids\Hashids;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //
    use NavBar;

    function index(){
        $data['trainers'] =Seller::where('cat_id',5)->get();
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['last_chemical_products'] = Product::orderby('id', 'desc')->where('status',1)->take(10)->get();
        // return $data;
        return view('customer.page.training')->with($data);
    }
    function request(Request $request){
        $request->validate([
            'seller_id'=>'required|exists:sellers,id',
            'customer_id'=>'required|exists:customers,id',
            'type_customer' => 'required',
        ]);
        $row = new Trining;
        $row->seller_id = $request->seller_id;
        $row->customer_id = $request->customer_id;
        $row->type_course = $request->type_customer;
        if($request->type_customer == 2){
            $row->start_date = $request->start_date;
            $row->end_date = $request->end_date;
            $row->trainees_num = $request->num_trainees;
            $row->trining_type = $request->type_training;
        }
        $row->save();
        return redirect()->back()->with('successfully','requested Successfully');
    }
    function track(){
        $data['trainings'] =Trining::where('customer_id',auth('customer')->user()->getAuthIdentifier())->with('trainer')->get();
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['last_chemical_products'] = Product::orderby('id', 'desc')->where('status',1)->take(10)->get();
        // return $data;
        return view('customer.page.track_training')->with($data);
    }
}
