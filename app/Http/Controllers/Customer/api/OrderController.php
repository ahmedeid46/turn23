<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\Charts;
use App\Models\ChTender;
use App\Models\Order;
use App\Models\Product;
use App\Models\AllProduct;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use APITrait,UploadFiles;
    //
    function file($location,$filename){
        $file = Storage::download('public/upload/order/'.decrypt($location).'/'.decrypt($filename));
        return $file;

    }
    function allOrder(){
        $orders =Order::Where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->with('product')->get();
        foreach ($orders as $order){
            if ($order->price != null) {
                $order['price'] = route('order.file', [encrypt('price'), encrypt($order->price)]);
            }
            if ($order->tds != null) {
                $order['tds'] = route('order.file',[encrypt('tds'),encrypt($order->tds)]);
            }
            if ($order->mods != null) {
                $order['coa'] = route('order.file', [encrypt('coa'), encrypt($order->coa)]);
            }

            //$order->product->cover = route('product.imgs', [encrypt('cover'), encrypt($order->product->cover)]);

        }

        $data['orders'] =$orders;
        return $this->returnSuccess('',$data);
    }
    function index(Request $request){
        $validated = Validator::make($request->all(), [
            'product_id'=>'required',
            "count"=>'required',
            "sample_required"=>"required",
            "coa_required"=>"required",
            "tds_required"=>"required",
            "msds_required"=>"required",
            "oc_required"=>"required",
            "approved_supplier"=>"required",
            "payment_method"=>"required",
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }

        try {
            $order = new Order;
            if($request->product_id == 'other'){
                $product = new AllProduct;
                $product->name = $request->product_name;
                $product->subcat_id = $request->subcat_id;
                $product->save();
                $order->product_id = $product->id;
            }else{
                $order->product_id = $request->product_id;
            }
            $order->count = $request->count;
            $order->customer_id = auth('customer-api')->user()->getAuthIdentifier();
            $order->price =null;
            $order->coa_required = $request->coa_required;
            $order->tds_required = $request->tds_required;
            $order->msd_required = $request->msds_required;
            $order->oc_required = $request->oc_required;
            $order->sample_required = $request->sample_required;
            $order->approved_supplier = $request->approved_supplier;
            $order->payment_method = $request->payment_method;
            $order->payment_day = $request->payment_day;
            $order->ex_delevery = $request->ex_delevery;
            $order->save();
            return $this->returnSuccess(['Order Added'],'',200);
        }catch (Exception $e){
            return $this->returnError(['message'=>'Server error','error'=>$e->getMessage()],500);
        }

    }
    function payment(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $orders =Order::firstWhere('id',$request->order_id);
        $product_ids = json_decode($orders->product_id);

        foreach ($product_ids as $product_id){
            $product= Product::with('allProduct')->find(json_decode($product_id)[1]);
            $num[] = $product_id;
            $count = json_decode($product_id)[0];
            $product['orderCount'] = $count;
            $price = 0;
            foreach (json_decode($orders->product_prices) as $product_prices){
                if ($product_prices[0] == json_decode($product_id)[1]){
                    $price = $product_prices[1];
                }
            }
            $products[] = $product;
            $paymentItem['name'] = $product->allProduct->name;
            $paymentItem['amount_cents'] = $price * 100;
            $paymentItem['description'] = $product->description;
            $paymentItem['quantity'] = $count;
            $paymentItems[] = $paymentItem;
        }
        $orders['products'] =$products;
        $data['order'] =$orders;


        $response = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymob.com/api/auth/tokens', ["api_key" => env('PAYMOB_API_KEY')]);
        $json = $response->json();

        $response_final = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
                "auth_token" => $json['token'],
                "delivery_needed" => "false",
                'merchant_order_id' => $orders->id, //put order id from your database must be unique id
                'amount_cents' => round($orders->price,2) * 100, //put your price
                'items' => $paymentItems,
            ]);

        $json_final = $response_final->json();
        $response_final_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
            "auth_token" => $json['token'],
            "expiration" => 36000,
            "amount_cents" => $json_final['amount_cents'],
            "order_id" => $json_final['id'],
            "billing_data" => [
                "apartment" => "NA",
                "email" => auth('customer-api')->user()->email,
                "floor" => "NA",
                "first_name" => auth('customer-api')->user()->name,
                "street" => "NA",
                "building" => "NA",
                "phone_number" => auth('customer-api')->user()->phone,
                "shipping_method" => "NA",
                "postal_code" => "NA",
                "city" => "NA",
                "country" => "NA",
                "last_name" => "NA",
                "state" => "NA"
            ],
            "currency" => "EGP",
            "integration_id" => env('PAYMOB_MODE') == "live" ? env('PAYMOB_LIVE_INTEGRATION_ID') : env('PAYMOB_SANDBOX_INTEGRATION_ID')
        ]);

        $response_final_final_json = $response_final_final->json();
        $data['Payment Link'] ='https://accept.paymob.com/api/acceptance/iframes/330970?payment_token='.$response_final_final_json['token'];
        return $this->returnSuccess('',$data,200);
    }
    function refuse_price(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->save();
            return $this->returnSuccess('Quotation Refuse Successfully');
        }catch (\Exception $e){
            return $this->returnError('server Error',500);
        }
    }
    function accept_price(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $order = Order::find($request->order_id);
            $order->status = 3;
            $order->save();
            return $this->returnSuccess('Quotation Accepted Successfully');
        }catch (\Exception $e){
            return $this->returnError('server Error',500);
        }
    }

    function tenders(){
        $tenders = ChTender::with('tender_price')->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->get();
        foreach ($tenders as $tender){
            foreach ($tender->tender_price as $tender_price){
                $tender_price->tender_price = $tender_price->tender_price;
            }
        }
        $data['tenders'] = $tenders;
        return $this->returnSuccess('',$data);
    }
    function tender_request(Request $request){
        $validated = Validator::make($request->all(), [
            "tender_file"=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try{
            $tender = new ChTender;
            $tender->customer_id = auth('customer-api')->user()->getAuthIdentifier();
            $tender->tender_file = $this->orderUploadFile('tender',$request->tender_file,'tender');
            $tender->save();
            return $this->returnSuccess('Tender Added successfully','');
        }catch (Exception $e){
            return $this->returnError('Server Error',500);
        }
    }
    function tender_delete(Request $request){
        $validated = Validator::make($request->all(), [
            "tender_id"=>'required|exists:ch_tenders',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $tender = ChTender::find($request->tender_id);
            $tender->delete();
            return $this->returnSuccess('Tender Deleted');
        }catch (Exception $e){
            return $this->returnError('Server Error',500);
        }
    }
}
