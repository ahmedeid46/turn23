<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\ServicePriceList;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use UploadFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            $service = new Service;
            $service->code = "CR".Service::latest()->first()->id+1;
            $service->customer_id = auth('customer')->user()->getAuthIdentifier();
            $service->sub_cat_id = $request->sub_cat_id;
            $service->drawing = $this->serviceUploadFile("CR".$service->id,$request->drawing,'drawing');
            $service->boq =$this->serviceUploadFile("CR".$service->id,$request->boq,'boq'); ;
            $service->vendorlist = $this->serviceUploadFile("CR".$service->id,$request->vendorlist,'vendorlist');;
            $service->project_specification = $this->serviceUploadFile("CR".$service->id,$request->project_specification,'project_specification');
            $service->specs = $this->serviceUploadFile("CR".$service->id,$request->specs,'specs');
            $service->other = $this->serviceUploadFile("CR".$service->id,$request->other,'other');
            $service->status = 0;
            $service->save();
            //return $service;
             return redirect()->back()->with('success','Request Added Successfully');
        }catch (Exception $e){
            //return $e->getMessage();
            return redirect()->back()->with('error','Request Error ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function update(UpdateServiceRequest $request)
    {
        //
        try {
            if($request->type = "cancel"){
                $service = Service::find($request->service_id);
                $service->delete();
                return redirect()->back()->with('success','Service Request is Deleted or Canceled Successfully');
            }elseif($request->type = "view"){
                $servicePrice = ServicePriceList::where('service_id',$request->service_id)->where('status',1)->first();
                return Storage::download('public/upload/product/pricelist/'.$servicePrice->file);
            }
        }catch (Exception $e){
            return redirect()->back()->with('error','founded error');
        }

    }

    public function rate(Request $request){
        try {
            $service = Service::find($request->service_id);
            $service->rate = $request->rate;
            $service->save();
            return redirect()->back()->with('success','Rate Added Successfully');
        }catch (Exception $e){
            return redirect()->back()->with('success','Rate Added error');
        }
    }

    function priceListSelection(Request $request){
        try {
            $price_list = ServicePriceList::find($request->priceList);
            $price_list->status = 2;
            $price_list->save();
            $service = Service::find($request->service);
            $service->status = 2;
            $service->save();
            return redirect()->back()->with('success','Accepted Successfully');
        }catch (Exception $e){
            return redirect()->back()->with('failed','error founded');
        }
    }
    function start(Request $request){
        $service = Service::find($request->service_id);
        $service->status = 10;
        $service->save();
        return redirect()->back()->with('success','Start Successfully');
    }
    function Complete(Request $request){
        $attendances = explode(",", $request->attendance);
        $service = Service::find($request->service_id);
        $service->status = 3;
        $service->attendees = json_encode($attendances);
        $service->save();
        return redirect()->back()->with('success','Complete Successfully');
    }
    function rateService(Request $request){
        $service = Service::find($request->service_id);
        $service->rate = $request->rate;
        $service->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
    public function file($type,$filename)
    {

        $file = Storage::download('public/upload/service/'.decrypt($type).'/'.decrypt($filename));

        return $file;
    }
    function priceListFormat(){
        $file = Storage::download('public/upload/format/priceListFormat.xlsx');

        return $file;
    }
}
