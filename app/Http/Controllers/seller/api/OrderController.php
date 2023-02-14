<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use App\Models\ChPriceTender;
use App\Models\ChTender;
use App\Models\IndOrderPrice;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\SellerCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use APITrait,UploadFiles;
    //
    function index(){
        $admin_orders=AdminOrder::with('adminProduct')->orderByDesc('created_at')->get();
        foreach ($admin_orders as $admin_order){
            if (!empty(OrderPrice::where('admin_order_id',$admin_order->id)->where('seller_id', auth('seller-api')->user()->getAuthIdentifier())->first())){
                $admin_order->upload_status = 1;
            }else{
                $admin_order->upload_status = 0;
            }
            $admin_order->status = Order::find($admin_order->order_id)->status;
        }
        $data['orders'] = $admin_orders;
        return $this->returnSuccess('',$data,200);

    }
    function addPriceOrder(Request $request){
        $validated = Validator::make($request->all(), [
            'admin_order_id'=>'required|exists:admin_orders,id',
            'price'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $price = new OrderPrice;
            $price->admin_order_id = $request->admin_order_id;
            $price->price = $request->price;
            $price->pay_method = $request->pay_method;
            if ($request->hasFile('coa')){
                $price->coa = $this->orderUploadFile('ind_',$request->coa,'coa');
            }
            if ($request->hasFile('tds')){
                $price->tds = $this->orderUploadFile('ind_',$request->tds,'tds');
            }
            if ($request->hasFile('msds')){
                $price->msds = $this->orderUploadFile('ind_',$request->msds,'msds');
            }
            if ($request->hasFile('oc')){
                $price->oc = $this->orderUploadFile('ind_',$request->oc,'oc');
            }
            $price->store_location = $request->store_location;
            $price->sample_request = $request->sample_request;
            $price->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $price->save();
            $order = AdminOrder::find($request->admin_order_id);
            $order->status = 1;
            $order->save();
            return $this->returnSuccess(['Price Are Saved Successfully']);
        }catch (\Exception $exception){
            return $this->returnError(['message'=>'Server Error','error'=>$exception->getMessage()],500);
        }
    }
    function tender(){
        $tenders = ChTender::where('status','>',0)->get();
        foreach ($tenders as $tender){
            if (!empty(ChPriceTender::where('tender_id',$tender->id)->where('seller_id', auth('seller-api')->user()->getAuthIdentifier())->first())){
                $tender->upload_status = 1;
            }else{
                $tender->upload_status = 0;
            }
            $tender->admin_tender_file  =  route('order.file',[encrypt('tender'),encrypt($tender->admin_tender_file)]);
        }
        $data['tender'] = $tenders;
        return $this->returnSuccess('',$data);
    }
    function tenderPrice(Request $request){
        $validated = Validator::make($request->all(), [
            'tender_id'=>'required|exists:ch_tenders,id',
            'price'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $price_tender = new ChPriceTender;
            $price_tender->tender_id = $request->tender_id;
            $price_tender->file = $this->orderUploadFile('tender_price',$request->price,'tenderPrice');
            $price_tender->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $price_tender->save();
            return $this->returnSuccess('Tender prices added Successfully','');
        }catch (Exception $e){
            return $this->returnError('Server Error',500);
        }
    }
}
