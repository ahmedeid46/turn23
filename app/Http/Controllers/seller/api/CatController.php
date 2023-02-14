<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\AllProduct;
use App\Models\Cat;
use App\Models\Seller;
use App\Models\SellerCat;
use App\Models\SubCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class CatController extends Controller
{
    use APITrait;
    use UploadFiles;
    //
    function index(){
         $cats = SellerCat::where("seller_id",auth('seller-api')->user()->getAuthIdentifier())->with('subCat')->get();
        $items = [];
         foreach ($cats as $cat){
           // $cat->subCat['image'] = route('category.img',$cat->subCat['image']);
            if($cat->subCat->cat_id == 1) {

                foreach ($cat->subCat->allproduct as $allproduct) {
                    foreach ($allproduct->product as $product) {
                        $product['cover'] = route('product.files', [encrypt('cover'), encrypt($product['cover'])]);
                        $product['mods'] = route('product.files', [encrypt('mods'), encrypt($product['mods'])]);
                        $product['tds'] = route('product.files', [encrypt('tds'), encrypt($product['tds'])]);
                        $product['coa'] = route('product.files', [encrypt('coa'), encrypt($product['coa'])]);
                        $newphotos = [];
                        if ($product['photos'] != null) {
                            foreach (json_decode($product['photos']) as $photo) {
                                $newphotos[] = route('product.files', [encrypt('photo'), encrypt($photo)]);
                            }
                            $product['photos'] = $newphotos;
                        }
                        $newdocs = [];
                        if ($product['docs'] != null) {
                            foreach (json_decode($product['docs']) as $docs) {
                                $newdocs[] = route('product.files', [encrypt('docs'), encrypt($docs)]);
                            }
                            $product['docs'] = $newdocs;
                        }
                    }
                }
                $items[] = $cat;
            }
        }
        $data['cats'] = $items;
        return $this->returnSuccess('',$data,200);
    }
    function cats(){
        $cats = Cat::find(json_decode(auth('seller-api')->user()->cat_id));
        foreach ($cats as $cat) {
            $cat['cover'] = route('category.img', $cat->cover);
        }
        $data['categories'] = $cats;
        return $this->returnSuccess('',$data);
    }
    function addMainCat(Request $request){
        $validator = Validator::make($request->all(), [
            'cat_id'=>'required',
        ]);
        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        foreach ($request->cat_id as $cat){
            $user=Seller::find(auth('seller-api')->user()->getAuthIdentifier());
            $cats = json_decode($user->cat_id);
            if( in_array($cat,$cats)){
                return $this->returnError(['you selected this category befor'],200);
            }
            $cats[] = (int)$cat;
            //return $cats;
            $user->cat_id = json_encode($cats);
            if ($cat < 4) {
                if ($request->hasFile('registration_certificate')) {
                    $user->registration_certificate = $this->sellerUploadFile($request->name, $request->registration_certificate, 'registration');
                }
                if ($request->hasFile('tax_card')) {
                    $user->tax_card = $this->sellerUploadFile($request->name, $request->tax_card, 'tax');
                }
                if ($request->hasFile('vat_cert')){
                    $user->vat_cert = $this->sellerUploadFile($request->name, $request->vat_cert, 'vat');
                }
                if ($request->hasFile('delegation')) {
                    $user->delgation = $this->sellerUploadFile($request->name, $request->delegation, 'delegation');
                }
                if ($request->hasFile('reference_list')) {

                    $user->reference_list = $this->sellerUploadFile($request->name, $request->reference_list, 'reference');
                }
                $user->website = $request->website;
            } elseif ($cat == 4) {
                if ($request->hasFile('cv')) {

                    $user->cv = $this->sellerUploadFile($request->name, $request->cv, 'cv');
                }
                if ($request->hasFile('docs')) {
                    $user->docs = json_encode($this->sellerUploadmultiFile($request->name, $request->docs, 'docs'));
                }
            } elseif ($cat == 5) {
                if ($request->hasFile('docs')) {
                    $user->docs = json_encode($this->sellerUploadmultiFile($request->name, $request->docs, 'docs'));
                }
                $user->type_cource = $request->on_of;
                $user->work_space = $request->work_space;
                $user->location = $request->location;
                $user->price = $request->price;
                $user->price_type = $request->price_type;
                $user->Specialization = $request->Specialization;
                $user->min_num_trainees = $request->min_num_trainees;
                $user->start_date = $request->start_date;
                $user->end_date = $request->end_date;
                $user->bio = $request->bio;
            }
            $user->save();
        }
        return $this->returnSuccess('Category Register Successfully',200);
    }
    function allProductbyCat(Request $request){
        $validator = Validator::make($request->all(), [
            'sub_cat_id'=>'required',

        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        $data['products'] = AllProduct::where('subcat_id',$request->sub_cat_id)->get();
        return $this->returnSuccess('',$data);
    }
    function addSellerallSubCat(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'sub_cat_id' => 'required',
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        foreach ($request->sub_cat_id as $sub_cat_id) {
            if ($sub_cat_id != 'other') {
                $catcheck = SellerCat::where('seller_id',auth('seller-api')->user()->getAuthIdentifier())
                    ->where('sub_cat_id', $sub_cat_id)->count();
                if ($catcheck>0) continue;
                $row = new SellerCat;
                $row->seller_id = auth('seller-api')->user()->getAuthIdentifier();
                $row->sub_cat_id = $sub_cat_id;
                $row->save();
            } else {
                $validated = Validator::make($request->all(), [
                    'other_sub_cat_title' => 'required'
                ]);
                if ($validated->fails()) {
                    return $this->returnError($validated->errors()->all(), '400');
                }

                $subcat = new SubCat;
                $subcat->title = $request->other_sub_cat_title;
                $subcat->cat_id = auth('seller-api')->user()->cat_id;
                $subcat->save();
                $row = new SellerCat;
                $row->seller_id = auth('seller-api')->user()->getAuthIdentifier();
                $row->sub_cat_id = $subcat->id;
                $row->save();
            }
        }
        return $this->returnSuccess(['your sub Category is Added']);
    }
    function deleteSellerSubCat(Request $request){
        $validated = Validator::make($request->all(), [
            'sub_cat_id'=>'required|exists:sub_cats,id|exists:seller_cats,sub_cat_id'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $subcat = SellerCat::where('sub_cat_id',$request->sub_cat_id)
                ->where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->first();
            $subcat->delete();
            return $this->returnSuccess(['Delete Successful']);
        }catch (Exception $e){
            return $this->returnError(['server Error'],500);
        }
    }
    function addSellerSubCat(Request $request){
        $validated = Validator::make($request->all(), [
            'sub_cat_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        if ($request->sub_cat_id !='other'){
            $row = new SellerCat;
            $row->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $row->sub_cat_id = $request->sub_cat_id;
            $row->save();
            return $this->returnSuccess(['your sub Category is Added']);
        }else{
            $validated = Validator::make($request->all(), [
                'other_sub_cat_title' => 'required'
            ]);
            if ($validated->fails()) {
                return $this->returnError($validated->errors()->all(), '400');
            }
            $subcat = new SubCat;
            $subcat->title = $request->other_sub_cat_title;
            $subcat->cat_id = auth('seller-api')->user()->cat_id;
            $subcat->save();
            $row = new SellerCat;
            $row->seller_id = auth('seller-api')->user()->getAuthIdentifier();
            $row->sub_cat_id = $subcat->id;
            $row->save();
            return $this->returnSuccess(['your sub Category is Added,but should wait to approved by admin']);
        }
    }


}
