<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\AdminOrder;
use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\IndAdminOrder;
use App\Models\IndAdminProduct;
use App\Models\IndAllProduct;
use App\Models\IndOrder;
use App\Models\IndOrderPrice;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;

class IndAdminProductController extends Controller
{
    use UploadFiles;

    //
    function index(){
        $data['allProductsForSelect'] = IndAllProduct::all();
        $data['adminProducts'] = IndAdminProduct::with('allProduct')->get();
        return view('admin.page.industrial.adminProduct')->with($data);
    }
    function show($id){
        $data['product'] = IndAdminProduct::with('allProduct')->find($id);
        return view('admin.page.industrial.adminProduct-details')->with($data);
    }
    function create(StoreProductRequest $request){
        $validated = $request->validated();
        try {
            $product = new IndAdminProduct;
            $product->product_id = $request->product_id;
            $product->packing_type = $request->packing_type;
            $product->packing_wieght = $request->packing_wieght." ".$request->packing_wieght_unit;
            $product->origin = $request->origin;
            $product->producer = $request->producer;
            $product->description = $request->description;
            $product->content = $request['content'];

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
    function update(Request $request){
        $this->validate($request,[
            'id'=>'required|exists:admin_products,id',
            'product_id'=>'required|exists:all_products,id',
        ]);
        try {
            $product = IndAdminProduct::find($request->id);
            $product->product_id = $request->product_id;
            $product->packing_type = $request->packing_type;
            $product->packing_wieght = $request->packing_wieght." ".$request->packing_wieght_unit;
            $product->origin = $request->origin;
            $product->producer = $request->producer;
            $product->description = $request->description;
            $product->content = $request['content'];
            if ($request->hasFile('cover')) {
                $product->cover = $this->ProductUploadOneFile($request->name,$request->cover,'cover');
            }
            if ($request->hasFile('photos')) {
                $product->photos = json_encode($this->ProductUploadmultiFile($request->name,$request->photos,'photo'));
            }
            $product->save();
            return redirect()->back()->with('success','Successful Edit');
        }catch (\Exception $e){
            return redirect()->back()->with('error', "Editing Product failed");
        }

    }
    function delete(Request $request){
        $this->validate($request,[
            'product_id'=>'required|exists:admin_products,id',
        ]);
        try {
            $product = IndAdminProduct::find($request->product_id);
            $product->delete();
            return redirect()->back()->with('success','Deleting product Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error','Deleting product failed');
        }
    }
    function order(Request $request){
        $this->validate($request,[
            'product_id' =>'required|exists:ind_all_products,id',
        ]);
        try {
            $order = new IndAdminOrder;
            $order->order_id = $request->order_id;
            $order->product_id = $request->product_id;
            $order->save();
            $customerOrder = IndOrder::find($request->order_id);
            $customerOrder->status = 1;
            $customerOrder->save();
            return redirect()->back()->with('success','order successful');
        }catch (\Exception $e){
            return $e->getMessage();
            //return redirect()->back()->with('failed','order failed');
        }
    }
    function AdminOrders(){
        $data['orders'] = IndAdminOrder::with('adminProduct')->with('OrderPrices')->get();
        return view('admin.page.orders')->with($data);
    }
    function Show_price($id){
       $data['orders'] = IndAdminOrder::where('id',$id)->first();
       $data['prices'] = IndOrderPrice::with('seller')->where('admin_order_id',$id)->get();
       return view('admin.page.order-details')->with($data);
    }
    function acceptPrice($id){

    }
    function desablePrice($id){

    }
}
