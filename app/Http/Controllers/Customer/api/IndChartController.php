<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\AllProduct;
use App\Models\Charts;
use App\Models\IndAllProduct;
use App\Models\IndChart;
use App\Models\Wishlist;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndChartController extends Controller
{
    use APITrait;
    //
    function index(){
        $data['chart'] = IndChart::with('product')->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->get();
        foreach ($data['chart'] as $cart){
            $cart['productName'] = IndAllProduct::where('id',$cart->product->product_id)->first()->name;
            $cart['product']['cover'] = route('product.imgs', [encrypt('cover'), encrypt($cart->product->cover)]);

        }
        return $this->returnSuccess('',$data);
    }
    function add(Request $request){
        $validated = Validator::make($request->all(), [
            'product_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $chart = new IndChart;
            $chart->product_id = $request->product_id;
            $chart->customer_id = auth('customer-api')->user()->getAuthIdentifier();
            $chart->count = $request->count;
            $chart->save();
            return $this->returnSuccess(['product added in chart']);
        }catch (Exception $e){
            return $this->returnError(['error founded'],500);
        }

    }
    function delete(Request $request){
        $validated = Validator::make($request->all(), [
            'chart_id'=>'required|exists:ind_charts,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $chart = IndChart::find($request->chart_id);
            $chart->delete();
            return $this->returnSuccess(['product Delete from Chart']);
        }catch (Exception $e){
            return $this->returnError(['error founded'],500);
        }
    }
    function update(Request $request){
        $validated = Validator::make($request->all(), [
            'data'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }

        try {
            foreach ($request->data as $data){
                $chart = IndChart::find($data['cart_id']);
                $chart->count = $data['count'];
                $chart->save();
            }
            return $this->returnSuccess(['product Count Update in chart']);
        }catch (Exception $e){
            return $this->returnError(['error founded'],500);
        }
    }
}
