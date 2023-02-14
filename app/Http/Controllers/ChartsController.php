<?php

namespace App\Http\Controllers;

use App\Models\Charts;
use App\Http\Requests\StoreChartsRequest;
use App\Http\Requests\UpdateChartsRequest;
use App\Models\Wishlist;
use App\Traits\NavBar;
use Hashids\Hashids;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    use NavBar;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['ProductHashids'] = new Hashids(env('app_name').'Product',9);
        $data['navbar_menu'] = $this->customer();
        $data['carts'] = Charts::with('product')->where('customer_id',auth('customer')->user()->getAuthIdentifier())->get();
        return view('customer.page.cart')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeone(Request $request)
    {
        //
        $ProductHashids = new Hashids(env('app_name').'Product',9);
        $id = $ProductHashids->decode($request->encID);
        $oldWishlist = Charts::where('product_id',$id[0])->where('customer_id',auth('customer')->user()->getAuthIdentifier())->first();
        if ($oldWishlist == null){
            try {
                $wishlist = new Charts;
                $wishlist->product_id = $id[0];
                $wishlist->count = 1;
                $wishlist->customer_id = auth('customer')->user()->getAuthIdentifier();
                $wishlist->save();
                return response()->json([
                    "status"=>'successful',
                    "message" => 'This Product Added Successfully In Your Cart',
                ])->setStatusCode(200);
            }catch (Exception $e){
                return response()->json([
                    "status"=>'failed',
                    "message" => 'This Product Not Added In Your Cart',
                ])->setStatusCode(400);
            }
        }else{
            $oldWishlist->delete();
            return response()->json([
                "status"=>'delete',
                "message" => 'This Product Delete From cart',
            ])->setStatusCode(200);

        }

    }


    public function store(Request $request)
    {
        //

            try {
                $wishlist = new Charts;
                $wishlist->product_id = $request->product_id;
                $wishlist->count = $request->count;
                $wishlist->customer_id = auth('customer')->user()->getAuthIdentifier();
                $wishlist->save();
                return response()->json([
                    "status"=>'successful',
                    "message" => 'This Product Added Successfully In Your Cart',
                ])->setStatusCode(200);
            }catch (Exception $e){
                return response()->json([
                    "status"=>'failed',
                    "message" => 'This Product Not Added In Your Cart',
                ])->setStatusCode(400);
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Charts  $charts
     * @return \Illuminate\Http\Response
     */
    public function show(Charts $charts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Charts  $charts
     * @return \Illuminate\Http\Response
     */
    public function edit(Charts $charts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChartsRequest  $request
     * @param  \App\Models\Charts  $charts
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        //

        try {
            $cart = Charts::find($request->cart_id);
            $cart->count = $request->count;
            $cart->save();
        }catch (Exception $e){

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Charts  $charts
     * @return string
     */
    public function destroy($charts)
    {
        $ProductHashids = new Hashids(env('app_name').'Product',9);
        $id = $ProductHashids->decode($charts);
        //
        try {
            Charts::destroy($id );
            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back();
            //return $e->getMessage();
        }

    }
}
