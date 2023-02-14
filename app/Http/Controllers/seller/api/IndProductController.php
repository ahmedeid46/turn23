<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\AllProduct;
use App\Models\IndAllProduct;
use App\Models\IndProduct;
use App\Models\Product;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IndProductController extends Controller
{
    use UploadFiles,APITrait;
    //
    public function index(){
        $products = IndPrsoduct::with('allProduct')
            ->where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->get();
        return $this->returnSuccess('', compact('products'),'200');

    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'all_product_id'=>'required',
            'price'=>'required|numeric',
            'qty'=>'required|integer|min:1',
            'packing'=>'required',
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        try {
            $product = new IndProduct();
            if ($request->all_product_id == 'other'){
                $newProduct = new IndAllProduct;
                $newProduct->name = $request->product_name;
                $newProduct->subcat_id = $request->sub_cat_id;
                $newProduct->save();
                $product->product_id = $newProduct->id;
            }else{
                $product->product_id = $request->all_product_id;
            }
            $product->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $product->price = $request->price;
            $product->qty = $request->qty." ".$request->qtyunit;
            $product->origin = $request->origin;
            $product->matrial_constraction = $request->matrial_constraction;
            $product->dimension = $request->dimension." ".$request->dimension_unit;
            $product->schedule = $request->schedule;
            $product->capacity = $request->capacity." ".$request->capacity_unit;
            $product->ingress = $request->ingress;
            $product->rpm = $request->rpm;
            $product->pressure = $request->pressure." ".$request->pressure_unit;
            $product->tempratuve = $request->tempratuve." ".$request->tempratuve_unit;
            $product->save();
            return $this->returnSuccess(['Product Added Successfully']);
        }catch (Exception $e){
            return $this->returnError(['Product Added failed'],403);
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'=>'required',
            'all_product_id'=>'required',
            'price'=>'required|numeric',
            'qty'=>'required|integer|min:1',
            'packing'=>'required'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        try {
            $product = IndProduct::find($request->product_id);
            if ($request->all_product_id == 'other'){
                $newProduct = new AllProduct;
                $newProduct->name = $request->product_name;
                $newProduct->subcat_id = $request->sub_cat_id;
                $newProduct->save();
                $product->product_id = $newProduct->id;

            }else{
                $product->product_id = $request->all_product_id;
            }
            $product->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $product->old_price = $product->price;
            $product->price = $request->price;
            $product->qty = $request->qty." ".$request->qtyunit;
            $product->origin = $request->origin;
            $product->matrial_constraction = $request->matrial_constraction;
            $product->dimension = $request->dimension." ".$request->dimension_unit;
            $product->schedule = $request->schedule;
            $product->capacity = $request->capacity." ".$request->capacity_unit;
            $product->ingress = $request->ingress;
            $product->rpm = $request->rpm;
            $product->pressure = $request->pressure." ".$request->pressure_unit;
            $product->tempratuve = $request->tempratuve." ".$request->tempratuve_unit;
            $product->save();
            return $this->returnSuccess(['Product updated Successfully']);
        }catch (Exception $e){
            return $this->returnError(['Product Added failed'],403);
        }
    }
    /**
     * Display the specified resource.
     */
    public function file($type,$filename)
    {

        $file = Storage::get('public/upload/product/'.decrypt($type).'/'.decrypt($filename));

        return new Response($file, 200);
    }
    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id'=>'required|exists:ind_products,id'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        try {
            $product = IndProduct::find($request->product_id);
            $product->delete();
            return $this->returnSuccess(['Product Deleted successfully'],200);
        }catch (\Exception $e){
            return $this->returnError(['Product Deleted successfully'],400);
        }
    }
    function download_file(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'filename' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        return Storage::download('public/upload/product/'.$request->type.'/'.$request->filename);
    }
}
