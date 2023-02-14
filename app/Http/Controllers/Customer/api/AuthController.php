<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Mail\SendCodeResetPassword;
use App\Models\Customer;
use App\Models\PasswordReset;
use App\Models\Seller;
use App\Traits\APITrait;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
        if ($token = auth()->guard('customer-api')->attempt($credentials)) {
            $user = auth()->guard('customer-api')->user();
            $user['avtar'] = route('customer.avtar',$user['avtar']);
            $user['token'] = $this->respondWithToken($token);
            return $this->returnSuccess('Login Successful',$user,200);
        }else{
            return $this->returnError(['Email and Password are Wrong.'],401);
        }
    }
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('customer-api')->factory()->getTTL() * 60
        ];
    }
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'registration_certificate'=>'file',
            'tax_card'=>'file',
            'vat_cert'=>'file',
            'delegation'=>'file',
            'phone'=>'required',
            'reference_list'=>'file'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $user = new Customer;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->linkedin = $request->linkedin;
        if ($request->type_customer == 2){
            $user->registration_certificate =$this->customerUploadFile($request->name,$request->registration_certificate,'registration');
            $user->tax_card = $this->customerUploadFile($request->name,$request->tax_card,'tax');
            $user->vat_cert = $this->customerUploadFile($request->name,$request->vat_cert,'vat');
            $user->delgation = $this->customerUploadFile($request->name,$request->delegation,'delegation');
            $user->reference_list = $this->customerUploadFile($request->name,$request->reference_list,'reference');
            $user->website = $request->website;
        }
        $user->customer_type = $request->type_customer;
        $user->save();
        return $this->returnSuccess(['successfully Register check your email to known when admin approve your account']);
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
            }
            return $this->returnSuccess('Update file Successfully');
        }catch (\Exception $e){
            return $this->returnError('server error',500);
        }
    }
    function forgetPassword(Request $request){
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers',
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
    function editProfileData(){
        $data['user'] = auth('customer-api')->user();
        return $this->returnSuccess('',$data);
    }
    function updateProfile(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'string|min:8|confirmed',
            'password_confirmation' => 'string|min:8',
            'registration_certificate'=>'file',
            'tax_card'=>'file',
            'vat_cert'=>'file',
            'delegation'=>'file',
            'phone'=>'required',
            'reference_list'=>'file'
        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $user = Customer::find(auth('customer-api')->user()->getAuthIdentifier());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if (auth('customer-api')->user()->type_customer == 2){
            if ($request->hasFile('registration_certificate')){
                $user->registration_certificate =$this->customerUploadFile($request->name,$request->registration_certificate,'registration');
            }
            if ($request->hasFile('tax_card')){
                $user->tax_card = $this->customerUploadFile($request->name,$request->tax_card,'tax');
            }
            if ($request->hasFile('vat_cert')){
                $user->vat_cert = $this->customerUploadFile($request->name,$request->vat_cert,'vat');
            }
            if ($request->hasFile('delegation')){
                $user->delgation = $this->customerUploadFile($request->name,$request->delegation,'delegation');
            }
            if ($request->hasFile('reference_list')){
                $user->reference_list = $this->customerUploadFile($request->name,$request->reference_list,'reference');
            }
        }elseif (auth('customer-api')->user()->type_customer == 1){
            if ($request->hasFile('cv')) {
                $user->cv = $this->customerUploadFile($request->name, $request->cv, 'cv');
            }
        }
        if ($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $this->returnSuccess(['Update Successfully']);
    }
}
