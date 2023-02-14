<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\AllProduct;
use App\Models\IndWishlist;
use App\Models\Wishlist;
use App\Traits\APITrait;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndWishlistController extends Controller
{
    use APITrait,FileTrait;
    //
    function wishlist(){
//        if(!auth('customer')->check()){
//            return $this->returnError('please login',401);
//        }
        $wishlists = IndWishlist::with('product')
            ->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())
            ->get();
        foreach ($wishlists as $wishlist){
            $wishlist['productName'] = AllProduct::where('id',$wishlist->product->product_id)->first()->name;
            $wishlist['product']['cover'] = route('product.imgs', [encrypt('cover'), encrypt($wishlist->product->cover)]);

        }
        return $this->returnSuccess('',$wishlists);


    }
    function add(Request $request){

        $validated = Validator::make($request->all(), [
            'product_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $wishlist = new IndWishlist;
            $wishlist->product_id = $request->product_id;
            $wishlist->customer_id = auth('customer-api')->user()->getAuthIdentifier();
            $wishlist->save();
            return $this->returnSuccess(['product added in wishlist']);
        }catch (Exception $e){
            return $this->returnError(['error founded'],500);
        }
    }
    function delete(Request $request){

        $validated = Validator::make($request->all(), [
            'wishlist_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $wishlist = IndWishlist::find($request->wishlist_id);
            $wishlist->delete();
            return $this->returnSuccess(['product Delete from wishlist']);
        }catch (Exception $e){
            return $this->returnError(['error founded'],500);
        }
    }
}
