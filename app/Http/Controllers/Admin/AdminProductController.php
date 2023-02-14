<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\AdminOrder;
use App\Models\AdminProduct;
use App\Models\AllProduct;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Product;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    use UploadFiles;

    //
    function index(){
        $data['allProductsForSelect'] = AllProduct::all();
        $data['adminProducts'] = AdminProduct::with('allProduct')->get();
        return view('admin.page.adminProduct')->with($data);
    }
    function show($id){
        $data['product'] = AdminProduct::with('allProduct')->find($id);
        return view('admin.page.adminProduct-details')->with($data);
    }
    function create(StoreProductRequest $request){
        $validated = $request->validated();
        try {
            $product = new AdminProduct;
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
            $product = AdminProduct::find($request->id);
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
            $product = AdminProduct::find($request->product_id);
            $product->delete();
            return redirect()->back()->with('success','Deleting product Successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('error','Deleting product failed');
        }
    }
    function order(Request $request){
        $this->validate($request,[
            'product_id' =>'required|exists:all_products,id',
            'count' => 'required|min:0'
        ]);
        try {
            $order = new AdminOrder;
            $order->order_id = $request->order_id;
            $order->product_id = $request->product_id;
            $order->count = $request->count;
            $order->coa_required = $request->coa_required;
            $order->tds_required = $request->tds_required;
            $order->msd_required = $request->msd_required;
            $order->oc_required = $request->oc_required;
            $order->sample_required = $request->sample_required;
            $order->approved_supplier = $request->approved_supplier;
            $order->save();
            $customerOrder = Order::find($request->order_id);
            $customerOrder->status = 1;
            $customerOrder->save();
            return redirect()->back()->with('success','order successful');
        }catch (\Exception $e){
            return $e->getMessage();
            return redirect()->back()->with('failed','order failed');
        }
    }
    function AdminOrders(){
        $data['orders'] = AdminOrder::with('adminProduct')->with('OrderPrices')->get();
        return view('admin.page.orders')->with($data);
    }
    function Show_price($id){
       $data['orders'] = AdminOrder::where('id',$id)->first();
       $data['prices'] = OrderPrice::with('seller')->where('admin_order_id',$id)->get();
       return view('admin.page.order-details')->with($data);
    }
    function acceptPrice($id){

    }
    function desablePrice($id){

    }
}
