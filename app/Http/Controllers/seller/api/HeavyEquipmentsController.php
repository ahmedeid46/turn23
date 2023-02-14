<?php

namespace App\Http\Controllers\seller\api;

use App\Models\HeOrder;
use App\Models\SubCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\HeEquipmentPrice;
use App\Models\HeOrderPrice;

class HeavyEquipmentsController extends Controller
{
    use APITrait, UploadFiles;

    //
    function Orders()
    {
        $sub_cats = SubCat::where('cat_id', 6)->get();
        $orders = HeOrder::with('order_equipments', 'order_price')->get();
        foreach ($sub_cats as $subcat){
            $ordersSubcat = [];
            foreach ($orders as $order) {
                if ($order->site_photos != null && !is_array($order->site_photos)){
                    $orderphoto = [];
                    foreach (json_decode($order->site_photos) as $site_photo) {
                        $orderphoto[] = route('product.files', [encrypt('Equipment'), encrypt($site_photo)]);
                    }
                    $order->site_photos = $orderphoto;
                }
                foreach ($order->order_equipments as $order_equipment) {
                    $order_equipment->equipments->cover = route('category.img', $order_equipment->equipments->cover);
                    if ($order_equipment->copy_of_lifting_plan != null) {
                        $order_equipment->copy_of_lifting_plan = route('order.file', ['he_lifting_plan', $order_equipment->copy_of_lifting_plan]);
                    }
                }
                if ($order->type == $subcat->id){
                    $ordersSubcat[] = $order;
                }
            }
            $subcat['orders'] =  $ordersSubcat;

        }
        return $this->returnSuccess(' ', [
            "heavey" => $sub_cats
        ]);
    }
        function price(Request $request)
        {
            $validated = Validator::make($request->all(), [
                'order_id' => 'required|exists:he_orders,id',
                'docs' => 'required',
                'photos' => 'required',
                'equipments' => 'required',
            ]);
            if ($validated->fails()) {
                return $this->returnError($validated->errors()->all(), '400');
            }
            $price = new HeOrderPrice;
            $price->order_id = $request->order_id;
            $price->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $price->docs = json_encode($this->ProductUploadmultiFile('Equipment', $request->docs, 'equipment_docs'));
            $price->photos = json_encode($this->ProductUploadmultiFile('Equipment', $request->photos, 'equipment_photos'));
            $price->save();
            foreach ($request->equipments as $equipment) {
                $item = new HeEquipmentPrice;
                $item->order_price_id = $price->id;
                $item->equipment_id = $equipment['equipment_id'];
                $item->price = $equipment['price'];
                $item->save();
            }
            return $this->returnSuccess('Equipment Price Added successfully', $request->post());

        }

}
