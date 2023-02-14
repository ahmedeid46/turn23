<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\SellerCat;
use App\Models\Service;
use App\Models\ServicePriceList;
use App\Models\SubCat;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;



class ServiceController extends Controller
{
    //
    use APITrait;
    function index(){
        $cats = SubCat::where('cat_id',3)->with('servicesubCat')->get();
        $sub_cats = SellerCat::where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->with('serviceCat')->get();
        $services =Service::where('status','>=',1)->with('seller_price_lists')->get() ;
        foreach ($cats as $cat) {
            $items_Cats = [];
            foreach ($sub_cats as $key => $sub_cat) {
                //return [$sub_cat->serviceCat->sub_cat_id,$cat->id];
                if ($sub_cat->serviceCat->sub_cat_id != $cat->id){
                    continue;
                }
                $items = [];
                foreach ($services as $service) {
                    $service['admin_drawing'] = route('service.files', [encrypt('drawing'), encrypt($service['admin_drawing'])]);
                    $service['admin_boq'] = route('service.files', [encrypt('boq'), encrypt($service['admin_boq'])]);
                    $service['admin_vendorlist'] = route('service.files', [encrypt('vendorlist'), encrypt($service['admin_vendorlist'])]);
                    $service['admin_project_specification'] = route('service.files', [encrypt('project_specification'), encrypt($service['admin_project_specification'])]);
                    $service['admin_specs'] = route('service.files', [encrypt('specs'), encrypt($service['admin_specs'])]);
                    $service['admin_other'] = route('service.files', [encrypt('other'), encrypt($service['admin_other'])]);
//                $service['file'] = route('service.files', [encrypt('file'), encrypt($service['file'])]);
                    if (count($service->seller_price_lists) < 1) {
                        $service['priceListAdded'] = 0;
                    } else {
                        $service['priceListAdded'] = 1;
                        foreach ($service->seller_price_lists as $pricelist) {
                            $pricelist['file'] = route('service.files', [encrypt('price'), encrypt($pricelist['files'])]);
                        }
                    }
                    if ($service->sub_cat_id == $sub_cat->sub_cat_id) {
                        $items[] = $service;
                    }
                }
                $sub_cat['serviceCat']['services'] = $items;
                //$sub_cat->makeHidden('serviceCat')->toArray();
                $items_Cats[] =$sub_cat['serviceCat'];
            }
            $cat['subsub_cat'] = $items_Cats;

        }
        return $this->returnSuccess('',$cats,200);
    }
//    function manpower(){
//        $cats = SubCat::where('cat_id',4)->with('servicesubCat')->get();
//        $sub_cats = SellerCat::where('seller_id',auth('seller-api')->user()->getAuthIdentifier())
//            ->with('serviceCat')->get();
//        //return $sub_cats;
//        $services =Service::where('status','>',0)->with('seller_price_lists')->get() ;
//        foreach ($cats as $cat){
//            foreach ($cat->servicesubCat as $subsubCat){
//                $items_Cats = [];
//                foreach ($sub_cats as $key=>$sub_cat){
//                    //return [$sub_cat->serviceCat->sub_cat_id,$subsubCat->id];
//                    if ($sub_cat->serviceCat->sub_cat_id != $subsubCat->id){
//                        continue;
//                    }
//                    $items = [];
//                    foreach ($services as $service) {
//                        unset($service['drawing']);
//                        unset($service['boq']);
//                        unset($service['vendorlist']);
//                        unset($service['project_specification']);
//                        unset($service['specs']);
//                        unset($service['other']);
//                        $service['file'] = route('service.files', [encrypt('file'), encrypt($service['file'])]);
//                        if (count($service->price_lists) < 1) {
//                            $service['priceListAdded'] = 0;
//                        } else {
//                            $service['priceListAdded'] = 1;
//                            foreach ($service->seller_price_lists as $pricelist) {
//                                $pricelist['file'] = route('service.files', [encrypt('price'), encrypt($pricelist['files'])]);
//                            }
//                        }
//                        if ($service->sub_cat_id == $sub_cat->sub_cat_id) {
//                            $items[] = $service;
//                        }
//                    }
//                        $sub_cat['serviceCat']['services'] = $items;
//                        //$sub_cat->makeHidden('serviceCat')->toArray();
//                        $items_Cats[] =$sub_cat['serviceCat'];
//                }
//                $subsubCat['subsub_cat'] = $items_Cats;
//            }
//
//        }
//        return $this->returnSuccess('',$cats,200);
//    }
    function manpower(){
        $sub_cats = SellerCat::where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->with('serviceCat')->get();
        $services =Service::where('status','>',0)->with('seller_price_lists')->get() ;
        $items = [];
        $items_Cats = [];
        foreach ($sub_cats as $key=>$sub_cat){
            if ($sub_cat->serviceCat->subCatReverse == null ) {
                continue;
            }
//            return $sub_cat->serviceCat->subCatReverse->subCatReverse->cat_id;
            if ($sub_cat->serviceCat->subCatReverse->subCatReverse == null || $sub_cat->serviceCat->subCatReverse->subCatReverse->cat_id != 4) {
                continue;
            }

            foreach ($services as $service) {
                unset($service['drawing']);
                unset($service['boq']);
                unset($service['vendorlist']);
                unset($service['project_specification']);
                unset($service['specs']);
                unset($service['other']);
              $service['file'] = route('service.files', [encrypt('file'), encrypt($service['file'])]);
                if (count($service->seller_price_lists) < 1) {
                    $service['priceListAdded'] = 0;
                } else {
                    $service['priceListAdded'] = 1;
                    foreach ($service->seller_price_lists as $pricelist) {
                        $pricelist['file'] = route('service.files', [encrypt('price'), encrypt($pricelist['files'])]);
                    }
                }
                if ($service->sub_cat_id == $sub_cat->sub_cat_id) {
                    $items[] = $service;
                }
            }
            $sub_cat['serviceCat']['services'] = $items;
            $sub_cat->serviceCat->makeHidden('subCatReverse')->toArray();
            $items_Cats[] =$sub_cat;
        }
        return $this->returnSuccess('',$items_Cats,200);
    }



    function service_price_list_add(Request $request){
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'file' => 'file'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        if ($request->hasFile('file')) {
            // Get filename with the extension
            $filenameWithExt = $request->file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = "PL" . $request->service_id . "0" . auth('seller-api')->user()->getAuthIdentifier() . time() . '.' . $extension;
            // Upload Image
            $path = $request->file->storeAs('public/upload/service/price', $fileNameToStore);
        }
        try {
            $price = new ServicePriceList;
            $price->service_id = $request->service_id;
            $price->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $price->code = "PL" . $request->service_id . "0" . auth('seller-api')->user()->getAuthIdentifier();
            if ($request->hasFile('file')) {
                $price->files = $fileNameToStore;
            }
            $price->price = $request->price;
            $price->price_rate = $request->price_rate;
            $price->duration =$request->duration;
            $price->start_date =$request->start_date;
            $price->residence = $request->residence;
            $price->transportation = $request->transport;
            $price->save();
            return $this->returnSuccess(['Price List Added Successfully']);
        }catch (\Exception $e){
            return $this->returnError(['Server Error','error' =>$e->getMessage()],500);
        }
    }
    function service_complete(Request $request){
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        $service = Service::find($request->service_id);
        $service->status = 3;
        $service->save();
        $price = ServicePriceList::where('service_id',$request->service_id)
            ->where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->first();
        $price->status = 3;
        $price->save();
        return $this->returnSuccess(['Service Complete Successfully'],'',200);
    }
    function download_file(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'filename' => 'required'
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        $file = Storage::download('public/upload/service/'.$request->type.'/'.$request->filename);
        return $file;

    }
}
