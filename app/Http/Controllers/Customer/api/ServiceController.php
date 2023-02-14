<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\Attendeese;
use App\Models\Service;
use App\Models\ServicePriceList;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    use APITrait,UploadFiles;
    //
    function index(Request $request){
        $validated = Validator::make($request->all(), [
        'sub_sub_cat_id'=>'required|exists:sub_cats,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $services = Service::where('sub_cat_id',$request->sub_sub_cat_id)
            ->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->get();
        foreach($services as $service){
            $service['drawing'] = route('service.files',[encrypt('drawing'),encrypt($service['drawing'])]);
            $service['boq'] = route('service.files',[encrypt('boq'),encrypt($service['boq'])]);
            $service['vendorlist'] = route('service.files',[encrypt('vendorlist'),encrypt($service['vendorlist'])]);
            $service['project_specification'] = route('service.files',[encrypt('project_specification'),encrypt($service['project_specification'])]);
//            $service['specs'] = route('service.files',[encrypt('specs'),encrypt($service['specs'])]);
            $service['other'] = route('service.files',[encrypt('other'),encrypt($service['other'])]);

        }
        $data['services'] = $services;
        return $this->returnSuccess('',$data,200);
    }

    function priceList(Request $request){
        $validated = Validator::make($request->all(), [
            'service_id'=>'required|exists:services,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $priceLists = ServicePriceList::where('service_id',$request->service_id)->where('status','>',0)->get();
        foreach ($priceLists as $priceList){
            $priceList['files'] = route('service.files',[encrypt('price'),encrypt($priceList['files'])]);
        }
        $data['priceLists'] = $priceLists;
        return $this->returnSuccess('',$data,200);
    }
    function request(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'sub_sub_cat_id' => 'required|exists:sub_cats,id',
            'drawing' => 'required|file',
            'boq' => 'required|file',
            'vendorlist' => 'required|file',
            'project_specification' => 'required|file',
//            'specs' => 'required|file',
            'other' => 'required|file',
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        try {
            $service = new Service;
            $service->code = "CR" . Service::latest()->first()->id + 1;
            $service->customer_id = auth('customer')->user()->getAuthIdentifier();
            $service->sub_cat_id = $request->sub_sub_cat_id;
            $service->drawing = $this->serviceUploadFile("CR" . $service->id, $request->drawing, 'drawing');
            $service->boq = $this->serviceUploadFile("CR" . $service->id, $request->boq, 'boq');;
            $service->vendorlist = $this->serviceUploadFile("CR" . $service->id, $request->vendorlist, 'vendorlist');;
            $service->project_specification = $this->serviceUploadFile("CR" . $service->id, $request->project_specification, 'project_specification');
//            $service->specs = $this->serviceUploadFile("CR" . $service->id, $request->specs, 'specs');
            $service->other = $this->serviceUploadFile("CR" . $service->id, $request->other, 'other');
            $service->status = 0;
            $service->save();
            return $this->returnSuccess(['Successful Added Service'], '', 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            //$this->returnError(['server Error'],500);
        }
    }
    function requestmanpower(Request $request){
            $validated = Validator::make($request->all(), [
                'sub_sub_cat_id'=>'required|exists:sub_cats,id',
                'name'=>'required',
                'file'=>'required|file',

            ]);
            if($validated->fails()){
                return $this->returnError($validated->errors()->all(),'400');
            }
            try {
                $service = new Service;
                $service->code = $request->name;
                $service->customer_id = auth('customer')->user()->getAuthIdentifier();
                $service->sub_cat_id = $request->sub_sub_cat_id;
                $service->file = $this->serviceUploadFile("CR".$service->id,$request->file,'file');
                $service->interview_option = $request->interview_option;
                $service->date_interview = $request->date_interview;
                $service->accommodation = $request->accommodation;
                $service->insurance  = $request->insurance;
                $service->taxes  = $request->taxes;
                $service->food  = $request->food;
                $service->transportation  = $request->transportation;
                $service->status = 0;
                $service->save();
                return $this->returnSuccess(['Successful Added Service'],'',200);
            }catch (\Exception $e){
                return $e->getMessage();
                //$this->returnError(['server Error'],500);
            }

    }
    function priceListAccept(Request $request){
        $validated = Validator::make($request->all(), [
            'price_list_id'=>'required|exists:service_price_lists,id',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $price_list = ServicePriceList::find($request->price_list_id);
        $price_list->status = 2;
        $price_list->save();
        $service = Service::find($price_list->service_id);
        $service->status = 2;
        $service->save();
        return $this->returnSuccess(['Accept Successfully'],'',200);
    }
    function delete(Request $request){
        $validated = Validator::make($request->all(), [
            'service_id'=>'required|exists:services,id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),400);
        }
        $service = Service::find($request->service_id);
        $service->delete();
        return $this->returnSuccess(['Delete Successfully'],'',200);
    }
    function start(Request $request){
        $validated = Validator::make($request->all(), [
            'price_list_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),400);
        }
        try {
            $service = ServicePriceList::find($request->price_list_id);
            $service->status = 10;
            $service->actual_start_time = now();
            $service->save();
            return $this->returnSuccess(['Start Successfully'],'',200);
        }catch (\Exception $e){
            return $this->returnError([$e->getMessage()],500);
        }
    }

    function completemanpower(Request $request){
        $validated = Validator::make($request->all(), [
            'price_list_id'=>'required',
            'reason'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),400);
        }
        try {
            $service = ServicePriceList::find($request->price_list_id);
            $service->status = 20;
            $service->reason = $request->reason;
            $service->actual_end_time = now();
            $service->save();
            return $this->returnSuccess(['Start Successfully'],'',200);
        }catch (\Exception $e){
            return $this->returnError([$e->getMessage()],500);
        }
    }
    function rate(Request $request){
        $validated = Validator::make($request->all(), [
            'price_list_id'=>'required',
            'reason'=>'required',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),400);
        }
        try {
            $service = ServicePriceList::find($request->price_list_id);
            $service->rate = $request->rate;
            $service->reason_rate = $request->reason;
            $service->actual_end_time = now();
            $service->save();
            return $this->returnSuccess(['Start Successfully'],'',200);
        }catch (\Exception $e){
            return $this->returnError([$e->getMessage()],500);
        }
    }
    function absence(Request $request){
        $validated = Validator::make($request->all(), [
            'price_list_id'=>'required',
            'date'=>'required',
            'status'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),400);
        }
        try {
            $pricelist = new Attendeese;
            $pricelist->price_list_id = $request->price_list_id;
            $pricelist->date = $request->date;
            $pricelist->status = $request->status;
            $pricelist->save();
            return $this->returnSuccess(['absence Register']);
        }catch (\Exception $exception){
            return $this->returnError(['Server error'],500);
        }
    }
    function Complete(Request $request){
        $validated = Validator::make($request->all(), [
            'service_id'=>'required|exists:services,id',

        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $price_list = ServicePriceList::find($request->price_list_id);
        $price_list->status = 3;
        $price_list->save();
        $service = Service::find($price_list->service_id);
        $service->status = 3;
        $service->save();
        return $this->returnSuccess(['Complete Successfully']);
    }

    function rejectpricelist(Request $request){
        $validated = Validator::make($request->all(), [
            'pricelist_id'=>'required|exists:service_price_lists,id',

        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $pricelist = ServicePriceList::find($request->pricelist_id);
            $pricelist->status = -1;
            $pricelist->save();
            $servise = Service::find($pricelist->service_id);
            $servise->status =0;
            $servise->save();
            return $this->returnSuccess(['Complete Successfully']);
        }catch (Exception $errors){
            return $this->returnError(['server error'],500);
        }
    }
}
