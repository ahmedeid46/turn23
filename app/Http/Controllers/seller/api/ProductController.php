<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\AllProduct;
use App\Models\Product;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use UploadFiles,APITrait;
    //
    public function index(){
        $products = Product::with('allProduct')
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
            $product = new Product();
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
            $product->price = $request->price;
            $product->qty = $request->qty." ".$request->qtyunit;
            $product->batch_number = $request->batch_number;
            $product->origin = $request->origin;
            $product->producer = $request->producer;
            $product->packing_wieght = $request->packing_wieght;
            $product->packing_wieght_unit = $request->packing_wieght_unit;
            $product->packing = $request->packing;
            $product->sample = $request->sample;
            $product->ProductionData = $request->productionData;
            $product->expirationDate = $request->expirationDate;
            $product->length = $request->length." ".$request->length_unit;
            $product->dim = $request->dim." ".$request->dim_unit;
            $product->in_out = $request->in_out;
            $product->sch = $request->sch;
            $product->pressure = $request->pressure." ".$request->Pressure_unit;
            $product->size = $request->size;
            $product->brand = $request->brand;
            $product->class = $request->class;
            $product->material = $request->material;
            $product->grade = $request->grade;
            $product->website = $request->website;
            $product->flowrate = $request->flowrate." ".$request->flow_rate_unit;
            $product->description = $request->description;
            $product->content = $request['content'];
            if ($request->hasFile('mods')) {
                $product->mods = $this->ProductUploadOneFile($request->name,$request->mods,'mods');
            }
            if ($request->hasFile('tds')) {
                $product->tds = $this->ProductUploadOneFile($request->name,$request->tds,'tds');
            }
            if ($request->hasFile('coa')) {
                $product->coa = $this->ProductUploadOneFile($request->name,$request->coa,'coa');
            }
            if ($request->hasFile('docs')) {
                $product->docs = json_encode($this->ProductUploadmultiFile($request->name,$request->docs,'docs'));
            }
            if ($request->hasFile('cover')) {
                $product->cover = $this->ProductUploadOneFile($request->name,$request->cover,'cover');
            }
            if ($request->hasFile('photos')) {
                $product->photos = json_encode($this->ProductUploadmultiFile($request->name,$request->photos,'photo'));
            }
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
            $product = Product::find($request->product_id);
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
            $product->packing = $request->packing;
            $product->sample = $request->sample;
            $product->ProductionData = $request->productionData;
            $product->expirationDate = $request->expirationDate;
            $product->length = $request->length." ".$request->length_unit;
            $product->dim = $request->dim." ".$request->dim_unit;
            $product->in_out = $request->in_out;
            $product->sch = $request->sch;
            $product->pressure = $request->pressure." ".$request->Pressure_unit;
            $product->size = $request->size;
            $product->brand = $request->brand;
            $product->class = $request->class;
            $product->material = $request->material;
            $product->grade = $request->grade;
            $product->website = $request->website;
            $product->flowrate = $request->flowrate." ".$request->flow_rate_unit;
            $product->description = $request->description;
            $product->content = $request['content'];
            if ($request->hasFile('mods')) {
                $product->mods = $this->ProductUploadOneFile($request->name,$request->mods,'mods');
            }
            if ($request->hasFile('tds')) {
                $product->tds = $this->ProductUploadOneFile($request->name,$request->tds,'tds');
            }
            if ($request->hasFile('coa')) {
                $product->coa = $this->ProductUploadOneFile($request->name,$request->coa,'coa');
            }
            if ($request->hasFile('docs')) {
                $product->docs = json_encode($this->ProductUploadmultiFile($request->name,$request->docs,'docs'));
            }
            if ($request->hasFile('cover')) {
                $product->cover = $this->ProductUploadOneFile($request->name,$request->cover,'cover');
            }
            if ($request->hasFile('photos')) {
                $product->photos = json_encode($this->ProductUploadmultiFile($request->name,$request->photos,'photo'));
            }
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
            'product_id'=>'required|exists:products,id'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        try {
            $product = Product::find($request->product_id);
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
