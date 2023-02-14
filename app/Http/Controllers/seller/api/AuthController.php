<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeResetPassword;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\PasswordReset;
use App\Models\Seller;
use App\Models\SellerCat;
use App\Models\SubCat;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    use APITrait,UploadFiles;
    //
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }

        $credentials = request(['email', 'password']);
        if ($token = auth()->guard('seller-api')->attempt($credentials)) {
            $user = auth()->guard('seller-api')->user();
            $message = '';
            if ($user->reg_cert_status  == 1 &&
                $user->tax_card_status  == 1 &&
                $user->vat_cert_status  == 1 &&
                $user->delgation_status == 1 &&
                $user->reference_status == 1){
                $user['companyFileStatus'] = 1;
            }else{
                $user['companyFileStatus'] = 0;
                $message = 'Please complete your Account';
            }
            if ($user->cv  == 1 &&
                $user->docs  == 1){
                $user['manpowerFileStatus'] = 1;
            }else{
                $user['manpowerFileStatus'] = 0;
                $message = 'Please complete your Account';
            }
            if ($user->docs  == 1){
                $user['trainerFileStatus'] = 1;
            }else{
                $user['trainerFileStatus'] = 0;
                $message = 'Please complete your Account';
            }
            $user['cat_id'] = json_decode($user->cat_id);
            $user['avtar'] = route('seller.avtar',$user['avtar']);
            $user['token'] = $this->respondWithToken($token);
            return $this->returnSuccess(['loginMessage'=>'Login Successful','statusMessage'=>$message],$user,200);
        }else{
            return $this->returnError(['Email and Password are Wrong.'],401);
        }
    }
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => ((auth()->guard('seller-api')->factory()->getTTL() * 60)/31536000)."Year"
        ];
    }
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:sellers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'registration_certificate'=>'file',
            'tax_card'=>'file',
            'vat_cert'=>'file',
            'phone'=>'required',
            'reference_list'=>'file',
            'cat_id'=>'required'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            $user = new Seller;
            $user->name =$request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone= $request->phone;
            $user->linkedin = $request->linkedin;
            $cats = [];
            foreach($request->cat_id  as $cat) {
                if ($cat < 4) {
                    if ($request->hasFile('registration_certificate'))
                        $user->registration_certificate = $this->sellerUploadFile($request->name, $request->registration_certificate, 'registration');
                        if ($request->hasFile('tax_card'))
                            $user->tax_card = $this->sellerUploadFile($request->name, $request->tax_card, 'tax');
                    if ($request->hasFile('vat_cert'))
                        $user->vat_cert = $this->sellerUploadFile($request->name, $request->vat_cert, 'vat');
                    if ($request->hasFile('delegation'))
                        $user->delgation = $this->sellerUploadFile($request->name, $request->delegation, 'delegation');
                    if ($request->hasFile('reference_list'))
                        $user->reference_list = $this->sellerUploadFile($request->name, $request->reference_list, 'reference');
                    $user->website = $request->website;
                } elseif ($cat == 4) {
                        if ($request->hasFile('cv'))
                            $user->cv = $this->sellerUploadFile($request->name, $request->cv, 'cv');
                        if ($request->hasFile('docs'))
                            $user->docs = json_encode($this->sellerUploadmultiFile($request->name, $request->docs, 'docs'));
                } elseif ($cat == 5) {
                    if ($request->hasFile('docs'))
                        $user->docs = json_encode($this->sellerUploadmultiFile($request->name, $request->docs, 'docs'));
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
                $cats[] = (int) $cat;
            }
            $user->cat_id = json_encode($cats);
            $user->save();
            return $this->returnSuccess(['successfully Register']);

        }catch (Exception $e){
            return $this->returnError(['failed Register'],500);

        }

    }
    public function completeRegister(Request $request){
        $validated = Validator::make($request->all(), [
            'file_type' => 'required',
            'file' => 'required|file',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        try {
            switch ($request->file_type){
                case "registration_certificate":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->registration_certificate = $this->sellerUploadFile($user->name,$request->file,'registration');
                    $user->reg_cert_status = 0;
                    $user->save();
                    break;
                case "tax_card":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->tax_card = $this->sellerUploadFile($user->name,$request->file,'tax');
                    $user->tax_card_status = 0;
                    $user->save();
                    break;
                case "vat_cert":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->vat_cert = $this->sellerUploadFile($user->name,$request->file,'vat');
                    $user->vat_cert_status = 0;
                    $user->save();
                    break;
                case "delgation":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->delgation = $this->sellerUploadFile($user->name,$request->file,'delgation');
                    $user->delgation_status = 0;
                    $user->save();
                    break;
                case "reference_list":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->reference_list = $this->sellerUploadFile($user->name,$request->file,'reference');
                    $user->reference_status = 0;
                    $user->save();
                    break;
                case "cv":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->cv = $this->sellerUploadFile($user->name,$request->file,'cv');
                    $user->cv_status = 0;
                    $user->save();
                    break;
                case "docs":
                    $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
                    $user->docs = json_encode($this->sellerUploadmultiFile($request->name,$request->file,'docs'));
                    $user->docs_status = 0;
                    $user->save();
                    break;
                default:
                    return $this->returnError('system error',500);
            }
            return $this->returnSuccess('Update file Successfully');
        }catch (\Exception $e){
            return $this->returnError('server error',500);
        }
    }
    function forgetPassword(Request $request){
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|exists:sellers,email',
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }

        // Delete all old code that user send before.
        PasswordReset::where('email', $request->email)->delete();

        // Create a new code
        $codeData = PasswordReset::create([
            'email' =>$request->email,
            'token' =>mt_rand(10000000, 99999999),
        ]);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->token));
        return $this->returnSuccess(['we send reset code to you ,check your email'],['email'=>$request->email]);
    }
    function CodeCheck(Request $request){
        $validated = Validator::make($request->all(), [
            'email'=>'required|exists:password_resets',
            'token' => 'required|string|exists:password_resets',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }

        // find the code
        $passwordReset = PasswordReset::firstWhere('token', $request->token);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return $this->returnError(['This Code Is Expired'],401);
        }
        $user = customer::firstWhere('email', $request->email);

        // update user password
        $user->update([
            'password'=> Hash::make($request->password)
        ]);

        // delete current code
        $passwordReset->delete();
        return $this->returnSuccess(['password has been successfully reset'],200);
    }
    function getCategory(Request $request){
        $data['cats'] = Cat::with('subCat')->get();
        return $this->returnSuccess('',$data,200);
    }
    function editProfileData(){
        $user = auth('seller-api')->user();
            $registration_certificate =null;
            if($user->registration_certificate != null){
                $registration_certificate = route('seller.file.only',['registration',$user->registration_certificate]);
            }
        $tax_card =null;
        if($user->tax_card != null){
            $tax_card = route('seller.file.only',['tax',$user->tax_card]);
        }
        $vat_cert =null;
        if($user->vat_cert != null){
            $vat_cert = route('seller.file.only',['vat',$user->vat_cert]);
        }
        $delgation =null;
        if($user->delgation != null){
            $delgation = route('seller.file.only',['delgation',$user->delgation]);
        }
        $reference_list =null;
        if($user->reference_list != null){
            $reference_list = route('seller.file.only',['registration',$user->reference_list]);
        }
        $cv =null;
        if($user->cv != null){
            $cv = route('seller.file.only',['cv',$user->cv]);
        }
        $docs = [];
        if($user->docs != null){
            foreach ($user->docs as $doc){
                $docs[] = route('seller.file.only',['docs',$user->$doc]);
            }
        }
        foreach (json_decode($user->cat_id) as $cat){
          switch ($cat){
              case '1':
                  $user['chemical']= compact('registration_certificate', 'tax_card', 'vat_cert', 'delgation', 'reference_list');
                  break;
              case '2':
                  $user['industrial']= compact('registration_certificate', 'tax_card', 'vat_cert', 'delgation', 'reference_list');
                  break;
              case '3':
                  $user['service_provider']= compact('registration_certificate', 'tax_card', 'vat_cert', 'delgation', 'reference_list');
                  break;
              case '4':
                  $user['manpower']= compact('cv', 'docs');
                  break;
              case '5':
                  $user['trainer']=[
                      'docs' => $docs,
                      'type_cource'=>$user->type_cource,
                      'work_space'=>$user->work_space,
                      'location'=>$user->location,
                      'price'=>$user->price,
                      'price_type'=>$user->price_type,
                      'Specialization'=> $user->Specialization ,
                      'min_num_trainees'=>$user->min_num_trainees ,
                      'start_date'=> $user->start_date,
                      'end_date'=> $user->end_date,
                      'bio'=> $user->bio,
                  ];
                  break;
              case '6':
                    $user['heavey']=[];
                  break;
          }
        }
        $user->makeHidden('registration_certificate')->toArray();
        $user->makeHidden('tax_card')->toArray();
        $user->makeHidden('vat_cert')->toArray();
        $user->makeHidden('delgation')->toArray();
        $user->makeHidden('cv')->toArray();
        $user->makeHidden('docs')->toArray();
        $user->makeHidden('type_cource')->toArray();
        $user->makeHidden('work_space')->toArray();
        $user->makeHidden('location')->toArray();
        $user->makeHidden('price')->toArray();
        $user->makeHidden('price_type')->toArray();
        $user->makeHidden('Specialization')->toArray();
        $user->makeHidden('min_num_trainees')->toArray();
        $user->makeHidden('start_date')->toArray();
        $user->makeHidden('end_date')->toArray();
        $user->makeHidden('bio')->toArray();
        $data['user'] = $user;
        return $this->returnSuccess('',$data);
    }
    function updateProfile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'string|min:8|confirmed',
            'password_confirmation' => 'string|min:8',
            'registration_certificate' => 'file',
            'tax_card' => 'file',
            'vat_cert' => 'file',
            'delegation' => 'file',
            'phone' => 'required',
            'reference_list' => 'file'
        ]);
        if ($validated->fails()) {
            return $this->returnError($validated->errors()->all(), '400');
        }
        $user = Seller::find(auth('seller-api')->user()->getAuthIdentifier());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->has('cats')){
            $user->cat_id =  json_encode($request->cats);
        }
        foreach (auth('seller-api')->user()->cat_id as $cat){
            if ($cat < 4) {
                if ($request->hasFile('registration_certificate')) {
                    $user->registration_certificate = $this->sellerUploadFile($request->name, $request->registration_certificate, 'registration');
                }
                if ($request->hasFile('tax_card')) {
                    $user->tax_card = $this->sellerUploadFile($request->name, $request->tax_card, 'tax');
                }
                if ($request->hasFile('vat_cert')) {
                    $user->vat_cert = $this->sellerUploadFile($request->name, $request->vat_cert, 'vat');
                }
                if ($request->hasFile('delegation')) {
                    $user->delgation = $this->sellerUploadFile($request->name, $request->delegation, 'delegation');
                }
                if ($request->hasFile('reference_list')) {
                    $user->reference_list = $this->sellerUploadFile($request->name, $request->reference_list, 'reference');
                }
            } elseif ($cat == 4) {
                if ($request->hasFile('cv')) {
                    $user->cv = $this->sellerUploadFile($request->name, $request->cv, 'cv');
                }
            } elseif ($cat == 5) {
                if ($request->has('docs')) {
                    $user->docs = $this->sellerUploadmultiFile($request->name, $request->docs, 'docs');
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
        }
        if ($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $this->returnSuccess(['Update Successfully']);
    }

}
