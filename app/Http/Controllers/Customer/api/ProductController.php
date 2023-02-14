<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\Product;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use APITrait;
    //
    function product(Request $request){
         $validated = Validator::make($request->all(), [
            'product_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $products = AllProduct::with('adminproduct')->where('id',$request->product_id)->get();
        foreach ($products as $allproduct) {
            foreach ($allproduct->adminproduct as $product){
                $product['cover'] = route('product.imgs', [encrypt('cover'), encrypt($product['cover'])]);
            if ($product['mods'] != null) {
                $product['mods'] = route('product.imgs', [encrypt('mods'), encrypt($product['mods'])]);
            }
            if ($product['coa'] != null) {
                $product['coa'] = route('product.imgs', [encrypt('coa'), encrypt($product['coa'])]);

            }
            if ($product['tds'] != null) {
                $product['tds'] = route('product.imgs', [encrypt('tds'), encrypt($product['tds'])]);
            }
            $newphotos = [];
            if ($product['photos'] != null) {
                foreach (json_decode($product['photos']) as $photo) {
                    $newphotos[] = route('product.imgs', [encrypt('photo'), encrypt($photo)]);
                }
            }
            $product['photos'] = $newphotos;
            $newdocs = [];
            if($product['docs'] != null){
                foreach (json_decode($product['docs']) as $doc){
                    $newdocs[]= route('product.imgs',[encrypt('docs'),encrypt($doc)]);
                }
            }
            $product['docs'] = $newdocs;
        }
        }
        $data['product'] = $products;
        return $this->returnSuccess('',$data);
    }
    function showfile(Request $request){
        $file = Storage::get('public/upload/product/'.$request->type.'/'.$request->filename);
        return new Response($file,200);
    }
    function slider(Request $request){
        $products = AdminProduct::latest()->take(5)->get();
        $sliders = [];
        foreach ($products as $product){
            $sliders[] = route('product.imgs',[encrypt('cover'),encrypt($product['cover'])]);
        }
        return $this->returnSuccess('',['sliders'=>$sliders]);
    }
}
