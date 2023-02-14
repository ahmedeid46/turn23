<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\Cat;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubCat;
use App\Models\Wishlist;
use App\Traits\NavBar;
use Hashids\Hashids;

class CustomerController extends Controller
{
    use NavBar;
    public function home()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['last_chemical_products'] = AdminProduct::with('allProduct')->orderby('id', 'desc')->take(10)->get();
       // return $data;
        return view('customer.page.home')->with($data);
    }
    public function about()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('customer.page.about')->with($data);
    }
    public function categories($enid){
        $hashids = new Hashids(env('app_name').'cats',7);
        $deid = $hashids->decode($enid);
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        $data['cat'] = Cat::with('subCat')->firstWhere('id',$deid);
        //return $data;
        return view('customer.page.categories')->with($data);
    }
    public function subcategories($enid){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $hashids = new Hashids(env('app_name').'subCats',8);
        $deid = $hashids->decode($enid);
        $data['navbar_menu'] = $this->customer();
        $data['subcat'] = SubCat::with('subsubCat')->firstWhere('id',$deid);
        return view('customer.page.subcategories')->with($data);
    }
    public function products($enid){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $hashids = new Hashids(env('app_name').'subCats',8);
        $deid = $hashids->decode($enid);
        $data['navbar_menu'] = $this->customer();
        $data['subcat'] = SubCat::with('subCatReverse')->firstWhere('id',$deid);
        $allproducts = AllProduct::with('adminproduct')->where('subCat_id',$deid)->get();
//        $products = [];
//        foreach ($allproducts as $allproduct){
//            $products[] = AdminProduct::where('product_id',$allproduct->id)->with('allProduct')->get();
//        }
        $data['allProducts'] = $allproducts;
        if (auth('customer')->check()){
            $data['wishlists'] = Wishlist::where('customer_id',auth('customer')->user()->getAuthIdentifier())->get();
        }
        return view('customer.page.product')->with($data);
        //return $data;
    }
    public function product($enid){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $hashids = new Hashids(env('app_name').'Product',9);
        $deid = $hashids->decode($enid);
        $data['navbar_menu'] = $this->customer();
        $data['product'] = AdminProduct::where('id',$deid)->with('allProduct')->first();
        return view('customer.page.product-details')->with($data);
        //return $data;

    }
    public function service($enid){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $hashids = new Hashids(env('app_name').'subCats',8);
        $deid = $hashids->decode($enid);
        $data['navbar_menu'] = $this->customer();
        $data['sub_cat_id'] = $deid;
        $data['services'] = Service::where('customer_id',auth('customer')->user()->getAuthIdentifier())->orderByDesc('id')
            ->with('price_lists', function ($query) {
                $query->where('status','=','1');
            })->where('sub_cat_id',$deid)->get();
        $data['catService'] = Cat::where('id',SubCat::where('id',$deid)->first()->cat_id)->first();
        $data['catManpower'] = Cat::where('id',SubCat::where('id',SubCat::where('id',$deid)->first()->sub_cat_id)->first()->cat_id)->first();

        return view('customer.page.company-service')->with($data);
    }
    public function industrial(){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('customer.page.industrial')->with($data);
    }
    public function contact(){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('customer.page.contact')->with($data);
    }

}
