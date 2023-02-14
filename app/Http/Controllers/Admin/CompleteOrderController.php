<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use App\Models\Cat;
use App\Models\GroupForTraining;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Service;
use App\Models\ServicePriceList;
use App\Models\SubCat;
use App\Models\Trining;

Class CompleteOrderController extends Controller {
    function index() {
        return view('admin.page.complete.all-buy');
    }
    function ChemicalOrder(){
        $data['orders']=Order::with('customer')->with('product')->where('status',2)->get();
        return view('admin.page.complete.buy-permision',$data);
    }
    function ChemicalOrderDetails($id){
        $data['orderadmin'] = AdminOrder::where('order_id',$id)->first();
        if($data['orderadmin'] != null ) {
            $data['prices'] = OrderPrice::with('seller')->where('admin_order_id', $data['orderadmin']['id'])->get();
        }

        $data['order']=Order::with('customer')->with('product')->where('status',2)->firstWhere("id",$id);
        //$cats = SellerCat::where("seller_id",auth('seller-api')->user()->getAuthIdentifier())->with('subCat')->get();
        $data['sellerproducts'] = Product::with('seller')->where("product_id",$data['order']->product->product_id)->get();
        return view('admin.page.complete.buy-permision-details',$data);
    }
    function catservice($id){
        $data['subcats'] = SubCat::where('cat_id',$id)->get();
        $data['title'] = 'sub';
        $data['type'] = 'service';
        return view('admin.page.complete.service-cat-permission-all')->with($data) ;
    }
    function catsmanpower(){
        $data['subcats'] = SubCat::where('cat_id',4)->get();
        $data['title'] = 'sub';
        $data['type'] = 'manpower';
        return view('admin.page.complete.service-cat-permission-all')->with($data) ;
    }
    function subcatservice($id){
        $data['title'] = 'subsub';
        $data['type'] = '';
        $data['subcats'] = SubCat::where('sub_cat_id',$id)->get();
        return view('admin.page.complete.service-cat-permission-all')->with($data);
    }
    function service($id){
        $data['services'] = Service::with('customer')->where('status',20)->where('sub_cat_id',$id)->orderByDesc('id')->with('subCat')->get();

//        return $data;
        return view('admin.page.complete.service-permision')->with($data);
    }
    function serviceDetails($id){
        $data['service'] = Service::with('customer')->with('subCat')->find($id);
        $data['catService'] = Cat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['catManpower'] = Cat::where('id',SubCat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['price_lists'] = ServicePriceList::with('service')->where('status','>',1)->where('service_id',$id)->with('seller')->first();
        return view('admin.page.complete.service-details')->with($data);
    }
    function servicePrice($id){
        $data['price_lists'] = ServicePriceList::with('service')->with('attendeense')->where('service_id',$id)->with('seller')->get();
        $data['catService'] = Cat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['catManpower'] = Cat::where('id',SubCat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->sub_cat_id)->first()->cat_id)->first();

        return view('admin.page.complete.service-pricelist')->with($data);
        //return $data;
    }
    function trainings(){
        return view('admin.page.complete.all-training');
    }
    function training_request(){
        $data['trainings'] = Trining::with('customer', 'trainer')->where('status',1)->get();
        //return $data;
        return view('admin.page.complete.training', $data);
    }
    public function training(){
        $data['trainees'] = Trining::where('status',0)->with('customer')->get();
        $data['trainers'] = Seller::get();
        $data['groups'] = GroupForTraining::with('training')->with('seller')->get();
        return view('admin.page.complete.addgroup')->with($data);
    }


}
