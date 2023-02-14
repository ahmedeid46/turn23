<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\AdminOrder;
use App\Models\IndAdminOrder;
use App\Models\IndOrderPrice;
use App\Models\IndPriceTender;
use App\Models\IndTender;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Models\SellerCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndOrderController extends Controller
{
    use APITrait,UploadFiles;
    //
    function index(){
        $admin_orders =IndAdminOrder::with('order')->with('adminProduct')->orderByDesc('created_at')->get();
        foreach ($admin_orders as $admin_order){
            if (!empty(IndOrderPrice::where('admin_order_id',$admin_order->id)->where('seller_id', auth('seller-api')->user()->getAuthIdentifier())->first())){
                $admin_order->upload_status = 1;
            }else{
                $admin_order->upload_status = 0;
            }
            if ($admin_order->order->specialRequirement != null){
                $admin_order->order->specialRequirement = route('order.file',[encrypt('specialRequirement'),encrypt($admin_order->order->specialRequirement)]);
            }
        }
        $data['orders'] =$admin_orders;
        return $this->returnSuccess('',$data,200);

    }
    function addPriceOrder(Request $request){
        $validated = Validator::make($request->all(), [
            'admin_order_id'=>'required|exists:ind_admin_orders,id',
            'price'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $price = new IndOrderPrice;
            $price->admin_order_id = $request->admin_order_id;
            $price->price = $request->price;
            $price->pay_method = $request->pay_method;            if ($request->hasFile('coa')){
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
            $order = IndAdminOrder::find($request->admin_order_id);
            $order->status = 1;
            $order->save();
            return $this->returnSuccess(['Price Are Saved Successfully']);
        }catch (\Exception $exception){
            return $this->returnError(['Server Error'],500);
        }
    }
    function tender(){
        $tenders = IndTender::where('status','>=',1)->get();
        foreach ($tenders as $tender){
            $tender->admin_tender_file  =  route('order.file',[encrypt('tender'),encrypt($tender->admin_tender_file)]);
            if (!empty(IndPriceTender::where('tender_id',$tender->id)->where('seller_id', auth('seller-api')->user()->getAuthIdentifier())->first())){
                $tender->upload_status = 1;
            }else{
                $tender->upload_status = 0;
            }
        }
        $data['tender'] = $tenders;
        return $this->returnSuccess('',$data);
    }
    function tenderPrice(Request $request){
        $validated = Validator::make($request->all(), [
            'tender_id'=>'required|exists:ind_tenders,id',
            'price'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $price_tender = new IndPriceTender;
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
