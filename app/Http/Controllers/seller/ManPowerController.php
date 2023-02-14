<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\SellerCat;
use App\Models\Service;
use App\Models\ServicePriceList;
use Illuminate\Http\Request;
use PharIo\Version\Exception;
use Symfony\Component\ErrorHandler\Debug;

class ManPowerController extends Controller
{
    //
    function requests(){
        $user = auth('seller')->user();
        $data['sub_cats'] = SellerCat::where('seller_id',$user->id)->get();
        $data['services'] =Service::orderByDesc('id')->where('status','>',0)->with('price_lists',function ($query) {
            $query->where('seller_id',auth('seller')->user()->id);
        })->get() ;

       // return $data;
       return view('seller.page.manpower.manpower')->with($data);
        //return Debug::enable();
    }
    function request_details($id){
        $data['services'] = Service::find($id);
        return view('seller.page.manpower.service-data')->with($data);
    }
    function accept(Request $request){
        // Get filename with the extension
        $filenameWithExt = $request->file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = "PL".$request->service_id."0".auth('seller')->user()->getAuthIdentifier().time() . '.' . $extension;
        // Upload Image
        $path = $request->file->storeAs('public/upload/service/price', $fileNameToStore);
        try {
            $price = new ServicePriceList;
            $price->service_id = $request->service_id;
            $price->seller_id = auth('seller')->user()->getAuthIdentifier();
            $price->code = "PL".$request->service_id."-".auth('seller')->user()->getAuthIdentifier();
            $price->files = $fileNameToStore;
            $price->start_date = $request->start_date;
            $price->duration = $request->duration;
            $price->residence = $request->accommodation;
            $price->save();
            return redirect()->back();
        }catch (Exception $e){
            //return redirect()->back();
            return  $e->getMessage();
        }
    }
    function complete(Request $request){
        $service = Service::find($request->service);
        $service->status = 3;
        $service->save();
        $price = ServicePriceList::find($request->priceList);
        $price->status = 3;
        $price->save();
        return redirect()->back();
    }

}
