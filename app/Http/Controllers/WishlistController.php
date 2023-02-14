<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;
use App\Traits\NavBar;
use Exception;
use Hashids\Hashids;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use NavBar;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['wishlists'] = Wishlist::with('product')->where('customer_id',auth('customer')->user()->getAuthIdentifier())->get();
        return view('customer.page.wishlist')->with($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $ProductHashids = new Hashids(env('app_name').'Product',9);
        $id = $ProductHashids->decode($request->encID);
        $oldWishlist = Wishlist::where('product_id',$id[0])->where('customer_id',auth('customer')->user()->getAuthIdentifier())->first();
        if ($oldWishlist == null){
            try {
                $wishlist = new Wishlist;
                $wishlist->product_id = $id[0];
                $wishlist->customer_id = auth('customer')->user()->getAuthIdentifier();
                $wishlist->save();
                return response()->json([
                    "status"=>'successful',
                    "message" => 'This Product Added Successfully In Your Wishlist',
                ])->setStatusCode(200);
            }catch (Exception $e){
                return response()->json([
                    "status"=>'failed',
                    "message" => 'This Product Not Added In Your Wishlist',
                ])->setStatusCode(400);
            }
        }else{
            $oldWishlist->delete();
            return response()->json([
                "status"=>'delete',
                "message" => 'This Product Delete From Wishlist',
            ])->setStatusCode(200);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
