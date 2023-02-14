<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\AllProduct;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\GroupForTraining;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SubCat;
use App\Models\TrainingGroup;
use App\Models\Trining;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $data['cats'] = Cat::where('type_id',1)->get();
        return view('admin.page.index')->with($data);
    }
    public function index2()
    {
        //
        $data['cats'] = Cat::where('type_id',1)->get();
        return view('admin.page.all-admin-product')->with($data);
    }
    public function index3()
    {
        //
        $data['cats'] = Cat::where('type_id',1)->get();
        return view('admin.page.all-all-product')->with($data);
    }
    public function subCat($id){
        $data['page'] = 'sc';
        $data['subCats'] = SubCat::where('cat_id',$id)->get();
        return view('admin.page.subCat')->with($data);
    }
    public function subsubCat($id){
        $data['page'] = 'ssc';
        $data['subCats'] = AllProduct::where('subCat_id',$id)->get();
        return view('admin.page.subCat')->with($data);
    }

    public function products($id){
        $data['products'] = Product::where('product_id',$id)->with('allProduct')->with('seller')->paginate(15);
        return view('admin.page.products')->with($data);
    }
    public function training(){
        $data['trainees'] = Trining::where('status',0)->with('customer')->get();
        $data['trainers'] = Seller::get();
        $data['groups'] = GroupForTraining::with('training')->with('seller')->get();
        return view('admin.page.addgroup')->with($data);
    }
}
