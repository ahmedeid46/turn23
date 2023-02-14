<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use App\Models\Cat;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\Seller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\SellerCat;
use App\Models\SubCat;
use App\Traits\UploadFiles;
use Hashids\Hashids;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    use UploadFiles;
    function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('auth:seller');
    }
    function home(){
        $data['cats'] = Cat::find(json_decode(auth('seller')->user()->cat_id));
        return view("seller.page.home")->with($data);
    }
    public function chemical()
    {
        $data['allCats'] = SubCat::where('cat_id',1)->get();
        $data['subcat'] = SellerCat::with('subCat')->where('seller_id',auth('seller')->user()->getAuthIdentifier())->get();
        $data['hashids'] = new Hashids(env('app_name'),7);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['orders'] =AdminOrder::orderByDesc('created_at')->with('adminProduct')->get();
        return view('seller.page.index-chemical')->with($data);
        //return $data;
    }
    function registrationCats(Request $request){
        $deleted = SellerCat::where('seller_id',auth('seller')->user()->id)->get();
        if (count($deleted) > 0){
            SellerCat::where('seller_id',auth('seller')->user()->id)->delete();
        }
        foreach ($request->subCat as $subcat){
            if($subcat == 'other'){
                $newSubCat = new SubCat();
                $newSubCat->title = $request->new_sub_cat;
                $newSubCat->cat_id = 1;
                $newSubCat->save();
                $row = new SellerCat;
                $row->sub_cat_id = $newSubCat->id;
                $row->seller_id = auth('seller')->user()->getAuthIdentifier();
                $row->save();
            }else{
                $row = new SellerCat;
                $row->sub_cat_id = $subcat;
                $row->seller_id = auth('seller')->user()->getAuthIdentifier();
                $row->save();
            }
        }
        return redirect()->back()->with('successful','your sub Categories is Added');

    }
    function registrationmanpowerCats(Request $request){
        $deleted = SellerCat::where('seller_id',auth('seller')->user()->id)->get();
        if (count($deleted) > 0){
            return redirect()->back()->with('notAllow',"Can't Edit Sub Category ");
        }
        foreach ($request->subCat as $subcat){
            if($subcat == 'other'){
                $newSubCat = new SubCat();
                $newSubCat->title = $request->new_sub_cat;
                $newSubCat->sub_cat_id = $request->new_sub_cat_id;
                $newSubCat->save();
                $row = new SellerCat;
                $row->sub_cat_id = $newSubCat->id;
                $row->seller_id = auth('seller')->user()->getAuthIdentifier();
                $row->save();
            }else{
                $row = new SellerCat;
                $row->sub_cat_id = $subcat;
                $row->seller_id = auth('seller')->user()->getAuthIdentifier();
                $row->save();
            }
        }

        return redirect()->back()->with('successful','your sub Categories is Added');

    }

    public function services(){
        $data['allCats'] = SubCat::where('cat_id',3)->with('subsubCat')->get();
        $data['subcats'] = SellerCat::with('subCat')->where('seller_id',auth('seller')->user()->getAuthIdentifier())->get();
        return view('seller.page.index-service')->with($data);
    }
    public function manpower(){
        $data['allCats'] = SubCat::where('cat_id',4)->with('subsubCat')->get();
        $data['subcats'] = SellerCat::with('subCat')->where('seller_id',auth('seller')->user()->getAuthIdentifier())->get();
        return view('seller.page.index-manpower')->with($data);
    }
    public function contact(){
        return view('seller.page.contact');
    }
    public function categories(){
        return view('seller.page.categories');
    }
    public function products(){
        return view('seller.page.chemical.products');
    }
    public function product(){
        return view('seller.page.chemical.product-details');
    }
    public function service(){
        return view('seller.page.service.services');
    }
    public function one_service(){
        return view('seller.page.service.service-data');
    }
    public function edit(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'image',
            'cv'=>'file',
            'registration_certificate'=>'file',
            'tax_card'=>'file',
            'vat_cert'=>'file',
            'invoice'=>'file',
            'delgation'=>'file',
            'reference_list'=>'file',
            'password' => 'min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
            'docs.*'=>'file',
        ]);
        $user = Seller::find(auth('seller')->user()->getAuthIdentifier());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('image')){
            $user->avtar = $this->sellerUploadFile($request->name,$request->image,'avtar');
        }
        if ($request->hasFile('cv')){
            $user->cv = $this->sellerUploadFile($request->name,$request->cv,'cv');

        }
        if ($request->hasFile('registration_certificate')){
            $user->registration_certificate = $this->sellerUploadFile($request->name,$request->registration_certificate,'registration');
        }
        if ($request->hasFile('tax_card')){
            $user->tax_card = $this->sellerUploadFile($request->name,$request->tax_card,'tax');
        }
        if ($request->hasFile('vat_cert')){
            $user->vat_cert = $this->sellerUploadFile($request->name,$request->vat_cert,'vat');
        }
        if ($request->hasFile('invoice')){
            $user->invoice = $this->sellerUploadFile($request->name,$request->invoice,'invoice');
        }
        if ($request->hasFile('delgation')){
            $user->delgation = $this->sellerUploadFile($request->name,$request->delgation,'delegation');
        }
        if ($request->hasFile('reference_list')){
            $user->reference_list = $this->sellerUploadFile($request->name,$request->reference_list,'reference');
        }
        if ($request->password != null){
            $user->password = $request->password;
        }
        if ($request->docs != null){
            $user->docs = $this->sellerUploadmultiFile($request->name,$request->docs,'docs');
        }
        if ($request->price != null){
            $user->price =$request->price;

        }
        if ($request->Specialization != null){
            $user->Specialization =$request->Specialization;
        }
        $user->save();
        return redirect()->back()->with('successful','Profile Updated Successfully');
    }
    public function order_price(Request $request){
        $request->validate([
            'order_id'=>'required|exists:admin_orders,id',
            'price'=>'required'
        ]);
        $price = new OrderPrice;
        $price->admin_order_id = $request->order_id;
        $price->price = $request->price;
        $price->seller_id = auth('seller')->user()->getAuthIdentifier();
        $price->save();
        $order = AdminOrder::find($request->order_id);
        $order->status = 1;
        $order->save();
        $price->save();
        return redirect()->back();
    }

}
