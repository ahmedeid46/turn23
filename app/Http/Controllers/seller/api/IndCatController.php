<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\AllProduct;
use App\Models\Cat;
use App\Models\IndAllProduct;
use App\Models\Seller;
use App\Models\SellerCat;
use App\Models\SubCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class IndCatController extends Controller
{
    use APITrait;
    use UploadFiles;
    //
    function index(){
         $cats = SellerCat::where("seller_id",auth('seller-api')->user()->getAuthIdentifier())->with('ind_cats')->get();
        $items = [];
        foreach ($cats as $cat){
//                if ($cat->ind_cats->subCatReverse->subCatReverse !=null){
//                    if($cat->ind_cats->subCatReverse->subCatReverse->subCatReverse !=null){
//                        if($cat->ind_cats->subCatReverse->subCatReverse->subCatReverse->subCatReverse !=null){
//                            if($cat->ind_cats->subCatReverse->subCatReverse->subCatReverse->subCatReverse->cat_id == 2 ) {
//                                // $cat->subCat['image'] = route('category.img',$cat->subCat['image']);
//                                foreach ($cat->ind_cats->ind_allproduct as $allproduct) {
//                                    foreach ($allproduct->product as $product) {
//                                        $product['cover'] = route('product.files', [encrypt('cover'), encrypt($product['cover'])]);
//                                        $product['mods'] = route('product.files', [encrypt('mods'), encrypt($product['mods'])]);
//                                        $product['tds'] = route('product.files', [encrypt('tds'), encrypt($product['tds'])]);
//                                        $product['coa'] = route('product.files', [encrypt('coa'), encrypt($product['coa'])]);
//                                        $newphotos = [];
//                                        if ($product['photos'] != null) {
//                                            foreach (json_decode($product['photos']) as $photo) {
//                                                $newphotos[] = route('product.files', [encrypt('photo'), encrypt($photo)]);
//                                            }
//                                            $product['photos'] = $newphotos;
//                                        }
//                                        $newdocs = [];
//                                        if ($product['docs'] != null) {
//                                            foreach (json_decode($product['docs']) as $docs) {
//                                                $newdocs[] = route('product.files', [encrypt('docs'), encrypt($docs)]);
//                                            }
//                                            $product['docs'] = $newdocs;
//                                        }
//                                    }
//                                }
//                                unset($cat->ind_cats->subCatReverse);
//                                $items[] = $cat;
//                            }
//                            continue;
//                        }
//                        if($cat->ind_cats->subCatReverse->subCatReverse->subCatReverse->cat_id == 2 ) {
//                            // $cat->subCat['image'] = route('category.img',$cat->subCat['image']);
//                            foreach ($cat->ind_cats->ind_allproduct as $allproduct) {
//                                foreach ($allproduct->product as $product) {
//                                    $product['cover'] = route('product.files', [encrypt('cover'), encrypt($product['cover'])]);
//                                    $product['mods'] = route('product.files', [encrypt('mods'), encrypt($product['mods'])]);
//                                    $product['tds'] = route('product.files', [encrypt('tds'), encrypt($product['tds'])]);
//                                    $product['coa'] = route('product.files', [encrypt('coa'), encrypt($product['coa'])]);
//                                    $newphotos = [];
//                                    if ($product['photos'] != null) {
//                                        foreach (json_decode($product['photos']) as $photo) {
//                                            $newphotos[] = route('product.files', [encrypt('photo'), encrypt($photo)]);
//                                        }
//                                        $product['photos'] = $newphotos;
//                                    }
//                                    $newdocs = [];
//                                    if ($product['docs'] != null) {
//                                        foreach (json_decode($product['docs']) as $docs) {
//                                            $newdocs[] = route('product.files', [encrypt('docs'), encrypt($docs)]);
//                                        }
//                                        $product['docs'] = $newdocs;
//                                    }
//                                }
//                            }
//                            unset($cat->ind_cats->subCatReverse);
//
//                            $items[] = $cat;
//                        }
//                        continue;
//                    }
//                    if($cat->ind_cats->subCatReverse->subCatReverse->cat_id == 2 ) {
//                        // $cat->subCat['image'] = route('category.img',$cat->subCat['image']);
//                        foreach ($cat->ind_cats->ind_allproduct as $allproduct) {
//                            foreach ($allproduct->product as $product) {
//                                $product['cover'] = route('product.files', [encrypt('cover'), encrypt($product['cover'])]);
//                                $product['mods'] = route('product.files', [encrypt('mods'), encrypt($product['mods'])]);
//                                $product['tds'] = route('product.files', [encrypt('tds'), encrypt($product['tds'])]);
//                                $product['coa'] = route('product.files', [encrypt('coa'), encrypt($product['coa'])]);
//                                $newphotos = [];
//                                if ($product['photos'] != null) {
//                                    foreach (json_decode($product['photos']) as $photo) {
//                                        $newphotos[] = route('product.files', [encrypt('photo'), encrypt($photo)]);
//                                    }
//                                    $product['photos'] = $newphotos;
//                                }
//                                $newdocs = [];
//                                if ($product['docs'] != null) {
//                                    foreach (json_decode($product['docs']) as $docs) {
//                                        $newdocs[] = route('product.files', [encrypt('docs'), encrypt($docs)]);
//                                    }
//                                    $product['docs'] = $newdocs;
//                                }
//                            }
//                        }
//                        unset($cat->ind_cats->subCatReverse);
//                        $items[] = $cat;
//                    }
//                    continue;
//                }
                if($cat->ind_cats->cat_id == 2 ) {
                    // $cat->subCat['image'] = route('category.img',$cat->subCat['image']);
                    foreach ($cat->ind_cats->ind_allproduct as $allproduct) {
                        foreach ($allproduct->product as $product) {
                            $product['cover'] = route('product.files', [encrypt('cover'), encrypt($product['cover'])]);
                            $product['mods'] = route('product.files', [encrypt('mods'), encrypt($product['mods'])]);
                            $product['tds'] = route('product.files', [encrypt('tds'), encrypt($product['tds'])]);
                            $product['coa'] = route('product.files', [encrypt('coa'), encrypt($product['coa'])]);
                            $newphotos = [];
                            if ($product['photos'] != null) {
                                foreach (json_decode($product['photos']) as $photo) {
                                    $newphotos[] = route('product.files', [encrypt('photo'), encrypt($photo)]);
                                }
                                $product['photos'] = $newphotos;
                            }
                            $newdocs = [];
                            if ($product['docs'] != null) {
                                foreach (json_decode($product['docs']) as $docs) {
                                    $newdocs[] = route('product.files', [encrypt('docs'), encrypt($docs)]);
                                }
                                $product['docs'] = $newdocs;
                            }
                        }
                    }
                    //unset($cat->ind_cats->subCatReverse);
                    $items[] = $cat;
                }
        }
        $data['cats'] = $items;
        return $this->returnSuccess('',$data,200);
    }
    function allProductbyCat(Request $request){
        $validator = Validator::make($request->all(), [
            'sub_cat_id'=>'required',

        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        $data['products'] = IndAllProduct::where('subcat_id',$request->sub_cat_id)->get();
        return $this->returnSuccess('',$data);
    }



}
