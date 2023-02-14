<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Service;
use App\Models\ServicePriceList;
use App\Models\SubCat;
use App\Notifications\SendPushNotification;
use App\Traits\NotificationTrait;
use App\Traits\UploadFiles;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
    use NotificationTrait;
    //
    function register(){

        $sellers = Seller::with('sellerCat')->orderByDesc('id')->with('cat')->get();
        $sumnewsellers=0;
        foreach ($sellers as $user){
            $cats = Cat::find(json_decode($user->cat_id));
            $user['allFileStatus'] = 0;
            foreach ($cats as $cat){
                switch ($cat->id){
                    case 1:
                    case 2:
                    case 3:
                        if ($user->reg_cert_status  == 1 &&
                            $user->tax_card_status  == 1 &&
                            $user->vat_cert_status  == 1 &&
                            $user->delgation_status == 1 &&
                            $user->reference_status == 1){
                            $user['companyFileStatus'] = 1;
                        }
                        break;
                    case 4:
                        if ($user->cv_status  == 1){
                            $user['manpowerFileStatus'] = 1;
                        }
                        break;
                    case 5:
                        if ($user->docs_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                }
            }
            if ($user['companyFileStatus'] != 1 && $user['manpowerFileStatus'] != 1){
                $sumnewsellers++;
            }
        }
        $data['sellercount'] = $sumnewsellers;
        $customers = customer::orderByDesc('id')->get();
        $sumnewcustomers=0;
        foreach ($customers as $user){
            $user['allFileStatus'] = 0;
            if ($user->customer_type == 2) {
                if ($user->reg_cert_status == 1 &&
                    $user->tax_card_status == 1 &&
                    $user->vat_cert_status == 1 &&
                    $user->invoice_status == 1 &&
                    $user->delgation_status == 1 &&
                    $user->reference_status == 1) {
                    $user['allFileStatus'] = 1;
                }
            }else{
                $user['allFileStatus'] = 1;
            }
            if ($user['allFileStatus'] !=1){
                $sumnewcustomers++;
            }
        }
        $data['customercount'] = $sumnewcustomers;
        return view('admin.page.register-permission-all')->with($data);
        //return $data;
    }
    function seller(){
        $users = Seller::with('sellerCat')->orderByDesc('id')->with('cat')->get();
        foreach ($users as $user){
            $cats = Cat::find(json_decode($user->cat_id));
            $user['allFileStatus'] = 0;
            foreach ($cats as $cat){
                switch ($cat->id){
                    case 1:
                    case 2:
                    case 3:
                        if ($user->reg_cert_status  == 1 &&
                            $user->tax_card_status  == 1 &&
                            $user->vat_cert_status  == 1 &&
                            $user->delgation_status == 1 &&
                            $user->reference_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                    case 4:
                        if ($user->cv_status  == 1 &&
                            $user->docs_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                    case 5:
                        if ($user->docs_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                }
            }
            $user['cats'] = $cats;
        }
        $data['type'] = 'seller';
        $data['users'] = $users;
//        return $data;
        return view('admin.page.register-permission')->with($data);

    }
    function customer(){
        $users = customer::orderByDesc('id')->get();
        foreach ($users as $user){
            $user['allFileStatus'] = 0;
            if ($user->customer_type == 2) {
                if ($user->reg_cert_status == 1 &&
                    $user->tax_card_status == 1 &&
                    $user->vat_cert_status == 1 &&
                    $user->invoice_status == 1 &&
                    $user->delgation_status == 1 &&
                    $user->reference_status == 1) {
                    $user['allFileStatus'] = 1;
                }
            }else{
                $user['allFileStatus'] = 1;
            }
        }
        $data['type']='customer';
        $data['users'] = $users;
        return view('admin.page.register-permission')->with($data);
    }
    function registerSellerDetails($id){
        $user = Seller::with('sellerCat')->orderByDesc('id')->where('id',$id)->first();
        $cats = Cat::find(json_decode($user->cat_id));
        $data['cats'] = $cats;
        $user['allFileStatus'] = 0;
        foreach ($cats as $cat){
            switch ($cat->id){
                case 1:
                case 2:
                case 3:
                    if ($user->reg_cert_status  == 1 &&
                        $user->tax_card_status  == 1 &&
                        $user->vat_cert_status  == 1 &&
                        $user->delgation_status == 1 &&
                        $user->reference_status == 1){
                        $user['allFileStatus'] = 1;
                    }
                    break;
                case 4:
                    if ($user->cv_status  == 1 &&
                        $user->docs_status == 1){
                        $user['allFileStatus'] = 1;
                    }
                    break;
                case 5:
                    if ($user->docs_status == 1){
                        $user['allFileStatus'] = 1;
                    }
                    break;
            }
        }

        $data['type'] = 'seller';
        $data['user'] = $user;
        return view('admin.page.registration-details')->with($data);
        //return $data;
    }
    function registerCustomerDetails($id){
        $user = Customer::orderByDesc('id')->where('id',$id)->first();
        $user['allFileStatus'] = 0;
        if ($user->reg_cert_status  == 1 &&
            $user->tax_card_status  == 1 &&
            $user->vat_cert_status  == 1 &&
            $user->invoice_status   == 1 &&
            $user->delgation_status == 1 &&
            $user->reference_status == 1){
            $user['allFileStatus'] = 1;
        }
        $data['type']='customer';
        $data['user'] = $user;
        return view('admin.page.registration-details')->with($data);
    }
    function registerSellerFile($type,$filename,$name){
        return Storage::download('public/upload/seller/'.$type.'/'.$filename);
    }
    function registerCustomerFile($type,$filename,$name){
        return Storage::download('public/upload/customer/'.$type.'/'.$filename);
    }
    function sellerAccept(Request $request){
        try {
            $user = Seller::firstWhere("id",$request->seller_id);
            $user->status = 1;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function sellerDecline(Request $request){
        try {
            $user = Seller::firstWhere('id',$request->seller_id);
            $user->status = -1;
            $user->decline_reason = $request->message;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }


    function product(){
        $data['users'] = Seller::with('sellerCat')->orderByDesc('id')->with('cat')->get();
        $data['products'] = Product::with('allProduct')->with('seller')->orderByDesc('id')->get();
        return view('admin.page.product-permision')->with($data);
        //return $data;
    }
    function productDetails($id){
        $data['product']  = Product::with('allProduct')->firstWhere('id',$id);
        return view('admin.page.product-permision-details')->with($data);
    }
    function productFile($type,$filename){
        return Storage::download('public/upload/product/'.$type.'/'.$filename);
    }
    function productAccept(Request $request){
        try {
            $user = Product::firstWhere('id',$request->id);
            $user->status = 1;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function productDecline(Request $request){
        try {
            $user = Product::find($request->id);
            $user->status = -1;
            $user->decline_reason = $request->message;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
use UploadFiles;
    function allbuy(){
        $data['orderscount']=Order::where('status',0)->count();
         return view('admin.page.all-buy')->with($data);
    }
    function buy(){
        $data['orders']=Order::with('customer')->where('status','<',5)->with('product')->get();

       return view('admin.page.buy-permision')->with($data);

    }
    function buyDetails($id){
        $data['orderadmin'] = AdminOrder::where('order_id',$id)->first();
        if($data['orderadmin'] != null ) {
            $data['prices'] = OrderPrice::with('seller')->where('admin_order_id', $data['orderadmin']['id'])->get();
        }

        $data['order']=Order::with('customer')->with('product')->where('status','<',6)->firstWhere("id",$id);
        //$cats = SellerCat::where("seller_id",auth('seller-api')->user()->getAuthIdentifier())->with('subCat')->get();
        $data['sellerproducts'] = Product::with('seller')->where("product_id",$data['order']->product_id)->get();
        return view('admin.page.buy-permision-details')->with($data);
        //return $data;
    }
    function addPriceToOrder(Request $request){
        $this->validate($request,[
            'order_id' =>'required',
            'price' => 'required',

        ]);
        $order = Order::find($request->order_id);
        $order->price = $this->orderUploadFile('admin_ch',$request->price,'price');
        $order->status =2;
        $order->save();
        return redirect()->back();

    }
    function buyComplete(Request $request){
        try {
            $user = Order::find($request->order_id);
            $user->status = 2;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function buyDecline(Request $request){
        try {
            $user = Order::find($request->id);
            $user->status = -1;
            $user->decline_reason = $request->message;
            $user->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }

    function allservice(){
        return view('admin.page.service-permission-all') ;
    }
    function catservice(){
        $data['subcats'] = SubCat::where('cat_id',3)->get();
        $data['title'] = 'sub';
        $data['type'] = 'service';
        return view('admin.page.service-cat-permission-all')->with($data) ;
    }
    function catsmanpower(){
        $data['subcats'] = SubCat::where('cat_id',4)->get();
        $data['title'] = 'sub';
        $data['type'] = 'manpower';
        return view('admin.page.service-cat-permission-all')->with($data) ;
    }
    function subcatservice($type,$id){
        $data['title'] = 'subsub';
        $data['type'] = $type;
        $data['subcats'] = SubCat::where('sub_cat_id',$id)->get();
        return view('admin.page.service-cat-permission-all')->with($data);
    }
    function service($type,$id){
        $data['services'] = Service::with('customer')->where('sub_cat_id',$id)->orderByDesc('id')->with('subCat')->get();
        $data['type'] = $type;
        return view('admin.page.service-permision')->with($data);
    }
    function serviceDetails($type,$id){
        $data['type'] = $type;
        $data['service'] = Service::with('customer')->with('subCat')->find($id);
        $data['catService'] = Cat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['catManpower'] = Cat::where('id',SubCat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['price_lists'] = ServicePriceList::with('service')->where('status','>',1)->where('service_id',$id)->with('seller')->first();
        //return $data;
        return view('admin.page.service-details')->with($data);
    }
    function serviceUpdate(Request $request){
        $service = Service::find($request->id);
        $service->admin_drawing = $this->serviceUploadFile("CR_admin" . $service->id, $request->drawing, 'drawing');
        $service->admin_boq = $this->serviceUploadFile("CR_admin" . $service->id, $request->boq, 'boq');
        $service->admin_vendorlist = $this->serviceUploadFile("CR_admin" . $service->id, $request->vendorlist, 'vendorlist');
        $service->admin_project_specification = $this->serviceUploadFile("CR_admin" . $service->id, $request->project_specification, 'project_specification');
        $service->admin_specs = $this->serviceUploadFile("CR_admin" . $service->id, $request->specs, 'specs');
        $service->admin_other = $this->serviceUploadFile("CR_admin" . $service->id, $request->other, 'other');
        $service->status = 1;
        $service->save();
    }
    function servicePrice($type,$id){
        $data['type'] = $type;
        $data['price_lists'] = ServicePriceList::with('service')->with('attendeense')->where('service_id',$id)->with('seller')->get();
        $data['catService'] = Cat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->cat_id)->first();
        $data['catManpower'] = Cat::where('id',SubCat::where('id',SubCat::where('id',Service::where('id',$id)->first()->sub_cat_id)->first()->sub_cat_id)->first()->cat_id)->first();

        return view('admin.page.service-pricelist')->with($data);
        //return $data;
    }
    function serviceFile($type,$filename){
        return Storage::download('public/upload/service/'.$type.'/'.$filename);
    }
    function serviceAccept(Request $request){
        try {
            $service = Service::find($request->id);
            $service->status = 1;
            $service->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function serviceDecline(Request $request){
        try {
            $service = Service::find($request->id);
            $service->status = -1;
            $service->decline_reason = $request->message;
            $service->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function priceAccept(Request $request){
        try {
            $price = ServicePriceList::find($request->id);
            if ( $price->status != 1){
                $price->status = 1;
            }else{
                $price->status = -1;
            }
            $price->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function priceDelete(Request $request){
        try {
            $price = Service::find($request->id);
            $price->status = -1;
            $price->decline_reason = $request->message;
            $price->save();
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back();
        }
    }
    function priceUpload(Request $request){
        $filenameWithExt = $request->file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = "PL".$request->service_id."0".time() . '.' . $extension;
        // Upload Image
        $path = $request->file->storeAs('public/upload/service/price', $fileNameToStore);

        $price = ServicePriceList::find($request->id);
        $price->files = $fileNameToStore;
        $price->save();

        return redirect()->back();
    }
    public function approve_registration_seller_file($userid,$code){
        $user = Seller::find($userid);
        if ($code == 'regCert'){
            $user->reg_cert_status= 1 ;
        }
        elseif ($code == 'tax'){
            $user->tax_card_status =1;
        }
        elseif ($code == 'vat'){
            $user->vat_cert_status= 1;
        }
        elseif ($code == 'delegation'){
            $user->delgation_status= 1;
        }
        elseif ($code == 'reference') {
            $user->reference_status = 1;
        }elseif ($code == 'cv') {
            $user->cv_status = 1;
        }elseif ($code == 'docs'){
            $user->docs_status = 1;
        }else{
            return redirect()->back()->withErrors('code','error occurred');
        }
        $user->save();
        return redirect()->back()->with('successful','Status Updated Successfully');
    }
    public function approve_registration_customer_file($userid,$code){
        $user = Customer::find($userid);
        if ($code == 'regCert'){
            $user->reg_cert_status= 1 ;
        }
        elseif ($code == 'tax'){
            $user->tax_card_status= 1 ;
        }
        elseif ($code == 'vat'){
            $user->vat_cert_status= 1;
        }
        elseif ($code == 'delegation'){
            $user->delgation_status= 1;
        }
        elseif ($code == 'reference'){
            $user->reference_status= 1;
        }else{
            return redirect()->back()->withErrors('code','error occurred');
        }
        $user->save();
        return redirect()->back()->with('successful','Status Updated Successfully');
    }
    public function refuse_registration_seller_file(Request $request){
        $user = Seller::find($request->user_id);
        if ($request->files_type == 'regCert'){
            $user->reg_cert_status= -1;
            $user->reg_cert_reason = $request->reason;
        }
        elseif ($request->files_type == 'tax'){
            $user->tax_card_status =-1;
            $user->tax_card_reason = $request->reason;
        }
        elseif ($request->files_type == 'vat'){
            $user->vat_cert_status= -1;
            $user->vat_cert_reason = $request->reason;
        }
        elseif ($request->files_type == 'delegation') {
            $user->delgation_status = -1;
            $user->delgation_reason = $request->reason;
        }
        elseif ($request->files_type == 'reference') {
            $user->reference_status = -1;
            $user->reference_reason = $request->reason;
        }
        elseif ($request->files_type == 'cv') {
            $user->cv_status = -1;
            $user->cv_reason = $request->reason;
        }elseif ($request->files_type == 'docs'){
            $user->docs_status = -1;
            $user->docs_reason = $request->reason;
        }else{
            return redirect()->back()->withErrors('code','error occurred');
        }
        $user->save();
        return redirect()->back()->with('successful','Status Updated Successfully');
    }
    public function refuse_registration_customer_file(Request $request){
        $user = Customer::find($request->user_id);
        if ($request->files_type == 'regCert'){
            $user->reg_cert_status= -1;
            $user->reg_cert_reason = $request->reason;
        }
        elseif ($request->files_type == 'tax'){
            $user->tax_card_status =-1;
            $user->tax_card_reason = $request->reason;
        }
        elseif ($request->files_type == 'vat'){
            $user->vat_cert_status= -1;
            $user->vat_cert_reason = $request->reason;
        }
        elseif ($request->files_type == 'delegation'){
            $user->delgation_status= -1;
            $user->delgation_reason = $request->reason;
        }
        elseif ($request->files_type == 'reference') {
            $user->reference_status = -1;
            $user->reference_reason = $request->reason;
        }else{
            return redirect()->back()->withErrors('code','error occurred');
        }
        $user->save();
        return redirect()->back()->with('successful','Status Updated Successfully');
    }


    public function sub_cat(){
        $data['subCats'] = SubCat::with('cat')->with('subCatReverse')->orderby('status')->get();
        return view('admin.page.sub_category_permision')->with($data);
    }
    function sub_cat_status_inverse($sub_cat){
        $row = SubCat::find($sub_cat);
        $row->status= ($row->status + 1)%2 ;
        $row->save();
        if ($row->status == 0){
            return redirect()->back()->with('success','Sub Category disabled');
        }else{
            return redirect()->back()->with('success','Sub Category available');
        }
    }
    public function allProduct(){
        $data['all_products'] = AllProduct::with('subcat')->where('status','0')->get();
        return view('admin.page.all_product_permision')->with($data);
    }
    function allProduct_status_inverse($product_id){
        $row = AllProduct::find($product_id);
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
