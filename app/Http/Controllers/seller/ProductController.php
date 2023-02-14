<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\AllProduct;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\SubCat;
use App\Traits\UploadFiles;
use Hashids\Hashids;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use UploadFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index($encid)
    {
        $hashids = new Hashids(env('app_name'),7);
        $sub_cat_id = $hashids->decode($encid);
        $data['sub_cat'] = SubCat::find($sub_cat_id);
        $data['hashids']= new Hashids(env('app_name'),9);
        $data['allProducts'] = allProduct::where('subcat_id',$sub_cat_id)->whereHas('product', function ($query) {
            $query->where('seller_id','=',auth('seller')->user()->getAuthIdentifier());
        })->with('product')->paginate(15);
        $data['allProductsForSelect'] = allProduct::where('subcat_id',$sub_cat_id)->get();
        return view('seller.page.chemical.products')->with($data);

    }

    public function show($encProductId){
        $hashids = new Hashids(env('app_name'),9);
        $decProductId = $hashids->decode($encProductId);
        $data['product'] = Product::where('id',$decProductId)->with('allProduct')->first();
        return view('seller.page.chemical.product-details')->with($data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(StoreProductRequest $request)
    {
        $validated = $request->validated();
        try {
            $product = new Product();
            $product->product_id = $request->product_id;
            $product->seller_id = $request->seller_id;
            $product->price = $request->price;
            $product->qty = $request->qty." ".$request->qtyunit;
            $product->packing = $request->packing;
            $product->sample = $request->sample;
            $product->ProductionData = $request->ProductionData;
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
            return redirect()->back()->withErrors('success','Adding Product successfully');
        }catch (Exception $e){
            return redirect()->back()->withErrors('error','Adding Product failed');
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




    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateProductRequest $request, $product)
    {
        $validated = $request->validated();
        try {
            $product = Product::find($product);
            $product->title = $request->title;
            $product->price = $request->price;
            $product->qty = $request->qty." ".$request->qtyunit;
            $product->packing = $request->packing;
            $product->sample = $request->sample;
            $product->ProductionData = $request->ProductionData;
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
            return redirect()->back()->withErrors('success','Adding Product successfully');
        }catch (Exception $e){
            return redirect()->back()->withErrors('error','Adding Product failed');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
