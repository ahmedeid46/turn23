<?php

namespace App\Http\Controllers;

use App\Models\AdminProduct;
use App\Models\Charts;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Traits\NavBar;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PayMob\Facades\PayMob;
//use Paymob\PayMob;


class OrderController extends Controller
{
    use NavBar;
    public $method;
    public $amount;
    public $token;
    public $currency;
    public $sk_code;
    public $usdtoegp;
    public $PAYMOB_API_KEY;
    public $FAWRY_MERCHANT;
    public $FAWRY_SECRET;
    public function __construct()
    {
        $this->PAYMOB_API_KEY = env('PAYMOB_API_KEY');
    }
    function show(){
        $data['orders'] = Order::where('customer_id',auth('customer')->user()->getAuthIdentifier())->get();
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['paymentHashids'] = new Hashids('payment',7);
        return view('customer.page.orders')->with($data);

    }
    function add(Request $request){
        $hasids = new Hashids('payment',7);
        $total_price = 0;
        foreach ($request->product as $count){
            $count = json_decode($count);
            $product = AdminProduct::find($count[1]);
            $number = $count[0];
            $total_price += $product['price']*$number;
        }
        try {
            $order = new Order;
            $order->product_id = json_encode($request->product);
            $order->customer_id = auth('customer')->user()->getAuthIdentifier();
            $order->price =null;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->country = $request->country;
            $order->save();
            foreach ($request->cart as $cart ){
               $chart = Charts::find($cart);
               $chart->delete();
            }
            return redirect()->route('customer.order.pay',$hasids->encode($order->id));
        }catch (Exception $e){
            return redirect()->back()->withErrors('error','the operation is refuse');
        }
       // return $request;

    }
    function payment($enid){
        $hasids = new Hashids('payment',7);
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $id = $hasids->decode($enid);
        $data['id'] = $id;
        $orders =Order::firstWhere('id',$id);
        $product_ids = json_decode($orders->product_id);
        foreach ($product_ids as $product_id){
            $product= AdminProduct::with('allProduct')->find(json_decode($product_id)[1]);

            $num[] = json_decode($product_id);
            $count = json_decode($product_id)[0];
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
        $data['order'] =$orders;
        $data['products'] =$products;
        $data['nums'] =$num;


        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://accept.paymob.com/api/auth/tokens', [
            'body' => '{"api_key":"ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam94TkRnek5ERjkuTG5mUWw5V05rcjB2ZHlscGZiUUlJbVk3STRpUERKcTY4QkFueFp6N1RIRXZOUHJjeUtsQnJSTm00SXlQWkNEdEF1WG9ObXdBOVpQUVNGUkQ5SkF0ZkE="}',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

       $json = json_decode($response->getBody());
        $response_final = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/ecommerce/orders', [
                "auth_token" => $json->token,
                "delivery_needed" => "false",
                'merchant_order_id' => $orders->id."pr".rand(1,1028739), //put order id from your database must be unique id
                'amount_cents' =>round($orders->price,2) * 100, //put your price
                'items' => $paymentItems,
            ]);

        $json_final = $response_final->json();
        $response_final_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
            "auth_token" => $json->token,
            "expiration" => 36000,
            "amount_cents" => $json_final['amount_cents'],
            "order_id" => $json_final['id'],
            "billing_data" => [
                "apartment" => "NA",
                "email" => auth('customer')->user()->email,
                "floor" => "NA",
                "first_name" => auth('customer')->user()->name,
                "street" => "NA",
                "building" => "NA",
                "phone_number" => auth('customer')->user()->phone,
                "shipping_method" => "NA",
                "postal_code" => "NA",
                "city" => "NA",
                "country" => "NA",
                "last_name" => "NA",
                "state" => "NA"
            ],
            "currency" => "EGP",
            "integration_id" => 1706060
        ]);

        $response_final_final_json = $response_final_final->json();
        $data['token'] = $response_final_final_json['token'];
        return view('customer.page.payment')->with($data);
    }
    public function paymob_payment_init()
    {

        $response = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/auth/tokens', ["api_key" => $this->PAYMOB_API_KEY]);
        $json = $response->json();

        $response_final = Http::withHeaders(['content-type' => 'application/json'])
            ->post('https://accept.paymobsolutions.com/api/ecommerce/orders', ["auth_token" => $json['token'], "delivery_needed" => "false", "amount_cents" => $this->amount_in_egp * 100, "items" => []]);

        $json_final = $response_final->json();

        $store_payment = $this->store_payment($payment_id = $json_final['id'], $amount = $this->calc_amout_after_transaction("paymob", $this->amount) , $source = "credit", $process_data = json_encode($json_final) , $currency_code = "USD", $status = strtoupper("PENDING") , $note = $this->amount_in_egp);

        $response_final_final = Http::withHeaders(['content-type' => 'application/json'])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys', [
            "auth_token" => $json['token'],
            "expiration" => 36000,
            "amount_cents" => $json_final['amount_cents'],
            "order_id" => $json_final['id'],
            "billing_data" => [
                "apartment" => "NA",
                "email" => \auth('customer')::user()->email,
                "floor" => "NA",
                "first_name" => auth('customer')::user()->name,
                "street" => "NA",
                "building" => "NA",
                "phone_number" => auth('customer')::user()->phone,
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
        $res = ['status' => 200,
            /*'response'=>$response,*/
            'redirect' => "https://accept.paymobsolutions.com/api/acceptance/iframes/" . env("PAYMOB_IFRAME_ID") . "?payment_token=" . $response_final_final_json['token'], 'message' => 'جار تحويلك إلى صفحة الدفع'];

        return $res;
    }
    public function paymob_payment_verify()
    {
//        if($request->obj->success == true){
//           $order = Order::find($request->obj->order->merchant->id);
//           $order->payment_type = 'online by paymob';
//           $order->status = 2;
//           $order->pay_code = $request->obj->order->id;
//           $order->save();
//        }else{
//            $order = Order::where('price',$request->obj->amount_cents/100)->find($request->obj->order->merchant->id);
//            $order->payment_type = 'Block Payment';
//            $order->pay_code = 0;
//            $order->status = -1;
//            $order->save();
//        }

    }
    public function set_payment_response($payment_id, $response)
    {
        $payment = Payment::where(['payment_id' => $payment_id, 'customer_id' => auth('customer')->user()
            ->id])
            ->firstOrFail();
        $payment->update(['payment_response' => $response]);
        return 1;
    }
    public function store_payment($payment_id, $amount, $source, $process_data, $currency_code, $status, $note = null)
    {
        $exists = \App\Balance_summary::where(['user_id' => \Auth::user()->id, 'payment_id' => $payment_id, ])->first();

        if ($exists == null)
        {
            $payment = \App\Balance_summary::create(["user_id" => \Auth::user()->id, 'payment_id' => $payment_id, "type" => "RECHARGE", "amount" => $amount, "status" => strtoupper($status) , "source" => $source, "currency_code" => strtoupper($currency_code) , "process_data" => (string)$process_data, "note" => $note]);
            return $payment->id;

        }
        else
        {
            return $exists->id;
        }
    }
}
