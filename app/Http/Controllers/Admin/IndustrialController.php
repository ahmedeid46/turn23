<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use App\Models\IndAdminOrder;
use App\Models\IndAllProduct;
use App\Models\IndOrder;
use App\Models\IndOrderPrice;
use App\Models\IndProduct;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\Seller;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustrialController extends Controller
{
    use UploadFiles;
    //
    function index(){
        $data['orders']=IndOrder::with('customer')->where('status','<',5)->with('product')->get();

        return view('admin.page.industrial.buy-permision')->with($data);

    }
    function buyDetails($id){
        $data['orderadmin'] = IndAdminOrder::where('order_id',$id)->first();
        if($data['orderadmin'] != null ) {
            $data['prices'] = IndOrderPrice::with('seller')->where('admin_order_id', $data['orderadmin']['id'])->get();
        }
        $order = IndOrder::with('customer')->with('admin_ind_all_product')->where('status','<',5)->firstWhere("id",$id);
        $data['order']= $order;
            //$cats = SellerCat::where("seller_id",auth('seller-api')->user()->getAuthIdentifier())->with('subCat')->get();
        $data['sellerproducts'] = IndProduct::with('seller')->where("product_id",$order->product_id)->get();
        return view('admin.page.industrial.buy-permision-details')->with($data);
        //return $data;
    }
    function addPriceToOrder(Request $request){
        $this->validate($request,[
            'order_id' =>'required',
            'price' => 'required',

        ]);
        $order = IndOrder::find($request->order_id);
        $order->price = $this->orderUploadFile('admin_ch',$request->price,'price');
        $order->status =2;
        $order->save();
        return redirect()->back();

    }
    function buyComplete(Request $request){
        try {
            $user = IndOrder::find($request->order_id);
            $user->status = 2;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function buyDecline(Request $request){
        try {
            $user = IndOrder::find($request->id);
            $user->status = -1;
            $user->decline_reason = $request->message;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }

    function product(){
        $data['products'] = IndProduct::with('allProduct')->with('seller')->orderByDesc('updated_at')->get();
        return view('admin.page.industrial.product-permision')->with($data);
        //return $data;
    }
    function productDetails($id){
        $data['product']  = IndProduct::with('allProduct')->firstWhere('id',$id);
        return view('admin.page.industrial.product-permision-details')->with($data);
    }
    function productFile($type,$filename){
        return Storage::download('public/upload/product/'.$type.'/'.$filename);
    }
    function productAccept(Request $request){
        try {
            $user = IndProduct::firstWhere('id',$request->id);
            $user->status = 1;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function productDecline(Request $request){
        try {
            $user = IndProduct::find($request->id);
            $user->status = -1;
            $user->decline_reason = $request->message;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }

    public function allProduct(){
        $data['all_products'] = IndAllProduct::with('subcat')->where('status','0')->get();
        return view('admin.page.industrial.all_product_permision')->with($data);
    }
    function allProduct_status_inverse($product_id){
        $row = IndAllProduct::find($product_id);
        $row->status= ($row->status + 1)%2 ;
        $row->save();
        if ($row->status == 0){

            return redirect()->back()->with('success','Product disabled');
        }else{


            $fcmTokens = Seller::where('cat_id',1)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            auth()->user()->notify(new SendPushNotification('Main Product','Admin Approve Main Product called'.$row->name,$fcmTokens));

            /* or */

//                Larafirebase::withTitle('Main Product')
//                    ->withBody('Admin Approve Main Product called'.$row->name)
//                    ->sendMessage($fcmTokens);

            //$this->sendNotificationForAllSeller('Main Product','Admin Approve Main Product called'.$row->name);
            return redirect()->back()->with('success','Product available');
        }
    }

}
