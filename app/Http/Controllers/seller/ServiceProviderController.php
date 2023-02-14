<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\SellerCat;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\ServicePriceList;
use Illuminate\Http\Request;
use PharIo\Version\Exception;

class ServiceProviderController extends Controller
{
    function requests(){
        $user = auth('seller')->user();
        $data['sub_cats'] = SellerCat::where('seller_id',$user->id)->get();
        $data['services'] =Service::orderByDesc('id')->with('price_lists',function ($query) {
            $query->where('seller_id',auth('seller')->user()->id);
        })->get() ;
        return view('seller.page.service.services')->with($data);
    }
    function description($id){
        $data['service'] = Service::find($id);
        return view('seller.page.service.service-data')->with($data);
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
            $price->save();
            return redirect()->back();
        }catch (Exception $e){
            //return redirect()->back();
            return  $e->getMessage();
        }
    }
    function request_Refuse(){

    }
}
