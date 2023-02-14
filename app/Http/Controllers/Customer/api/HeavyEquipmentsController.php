<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\HeOrder;
use App\Models\HeOrderEquipment;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeavyEquipmentsController extends Controller
{
    use APITrait,UploadFiles;
    //
    function orders(){
        $orders = HeOrder::with('order_equipments')->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->get();
        foreach ($orders as $order){
            $orderphoto = [];
            foreach (json_decode($order->site_photos) as $site_photo){
                $orderphoto[] = route('product.files',[encrypt('Equipment'), encrypt($site_photo)]);
            }
            $order->site_photos = $orderphoto;
            $adminphoto = [];
            if ($order->photos != null){
                foreach (json_decode($order->photos) as $admin_photo){
                    $adminphoto[] = route('order.file',[encrypt('Equipment/photos'),encrypt($admin_photo)]);
                }
            }

            $order->photos = $adminphoto;
            $docs = [];
            if ($order->docs != null) {
                foreach (json_decode($order->docs) as $admin_docs) {
                    $docs[] = route('order.file', [encrypt('Equipment/docs'), encrypt($admin_docs)]);
                }
            }
            $order->docs = $docs;
//            foreach($order->order_equipments as $order_equipment){
////                return $order_equipment->equipments->cover;
////                $order_equipment->equipments->cover = route('category.img',$order_equipment->equipments->cover);
//            }
        }
        return $this->returnSuccess(' ', ['orders'=>$orders],200);
    }
    function order_request(Request $request){
        $validated = Validator::make($request->all(), [
            'location' => 'required',
            'site_photos' => 'required',
            'equipments'=>'required',

        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        try {
            $order = new HeOrder;
            $order->location = $request->location;
            $order->site_photos = json_encode($this->ProductUploadmultiFile('Equipment',$request->site_photos,'Equipment'));
            $order->customer_id = auth('customer-api')->user()->getAuthIdentifier();
            $order->type = $request->type;
            $order->save();
            switch ($request->type) {
                    case 143:
                        $validated = Validator::make($request->all(), [
                            'equipments.*.sub_cat_id'=> 'required',
                            'equipments.*.lifting_plan'=>'file',
                        ]);
                        if ($validated->fails()) {
                            $order->delete();
                            return $this->returnError($validated->errors()->all(), '400');
                        }
                        foreach ($request->equipments as $equipment){
                            $order_equipment = new HeOrderEquipment;
                            $order_equipment->sub_cat_id = $equipment['sub_cat_id'];
                            $order_equipment->number = $equipment['number'];
                            $order_equipment->duration_type = $equipment['duration'];
                            if (!empty($equipment['start_date'])){
                                $order_equipment->start_date = date('Y-m-d H:i:s',strtotime($equipment['start_date'])) ;
                            }
                            if (!empty($equipment['end_date'])){
                                $order_equipment->end_date = date('Y-m-d H:i:s',strtotime($equipment['end_date']));
                            }
                            $order_equipment->capasty_load = $equipment['load_weight'].' '.$equipment['load_weight_unit'];
                            $order_equipment->lifting_hight = $equipment['lifting_height'].' '.$equipment['lifting_height_unit'];
                            $order_equipment->lifting_radius = $equipment['lifting_radius']." ".$equipment['lifting_radius_unit'];
                            if (!empty($equipment['lifting_plan']) && $equipment['lifting_plan'] != null ) {
                                $order_equipment->copy_of_liftong_plan = $this->orderUploadFile('HEorder', $equipment['lifting_plan'], 'he_lifting_plan');
                            }
                            $order_equipment->order_id = $order->id;
                            $order_equipment->save();
                        }
                        break;
                    case 145:
                    case 146:
                    case 144:
                        $validated = Validator::make($request->all(), [
                            'equipments.*.sub_cat_id'=> 'required',
                            'equipments.*.number'=> 'required|min:1',
                            'equipments.*.sizing'=>'required|min:1',

                        ]);
                        if ($validated->fails()) {
                            $order->delete();
                            return $this->returnError($validated->errors()->all(), '400');
                        }
                        foreach ($request->equipments as $equipment){
                            $order_equipment = new HeOrderEquipment;
                            $order_equipment->sub_cat_id = $equipment['sub_cat_id'];
                            $order_equipment->number = $equipment['number'];
                            $order_equipment->duration_type = $equipment['duration'];
                            if (!empty($equipment['start_date'])){
                                $order_equipment->start_date = date('Y-m-d H:i:s',strtotime($equipment['start_date'])) ;
                            }
                            if (!empty($equipment['end_date'])){
                                $order_equipment->end_date = date('Y-m-d H:i:s',strtotime($equipment['end_date']));
                            }
                            $order_equipment->sizing = $equipment['sizing'];
                            $order_equipment->order_id = $order->id;
                            $order_equipment->save();
                        }
                        break;
                    default:
                        $order->delete();
                        return $this->returnError('Bad request',400);
                }
            return $this->returnSuccess('order added successfully','',200);

        }catch (Exception $e){
            $order->delete();
            return $this->returnError(['Server Error',$e->getMessage()],500);

        }

    }
    function delete(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:he_orders,id',
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        $order = HeOrder::find($request->order_id);
        $order->delete();
        $orderequipment = HeOrderEquipment::where('order_id', $request->order_id);
        $orderequipment->delete();
        return $this->returnSuccess(['Delete Successfully']);
    }
    function acceptPrice(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:he_orders,id',
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        $order = HeOrder::find($request->order_id);
        $order->status =3;
        $order->save();
        return $this->returnSuccess(['Price Accepted']);
    }
    function refusePrice(Request $request){
        $validated = Validator::make($request->all(), [
            'order_id' => 'required|exists:he_orders,id',
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        $order = HeOrder::find($request->order_id);
        $order->status =1;
        //$order->price = null;
        $order->save();
        return $this->returnSuccess(['Price Refused']);
    }
}
