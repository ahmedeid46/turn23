<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Traits\NavBar;
use App\Traits\UploadFiles;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use UploadFiles;
    protected $redirectTo = '/';
    use NavBar;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //section construct
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:customer');
    }
    // section show register
    public function showRegister()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        return view('customer.auth.register')->with($data);
    }
    // section register
    protected function register(StoreCustomerRequest $request)
    {
        $validated = $request->validated();
        $user = new Customer;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->linkedin = $request->linkedin;

        // Upload Files
        if ($request->type_customer == 2){
            $user->registration_certificate =$this->customerUploadFile($request->name,$request->registration_certificate,'registration');
            $user->tax_card = $this->customerUploadFile($request->name,$request->tax_card,'tax');
            $user->vat_cert = $this->customerUploadFile($request->name,$request->vat_cert,'vat');
            $user->invoice = $this->customerUploadFile($request->name,$request->invoice,'invoice');
            $user->delgation = $this->customerUploadFile($request->name,$request->delegation,'delegation');
            $user->reference_list = $this->customerUploadFile($request->name,$request->reference_list,'reference');
            $user->website = $request->website;

        }
        $user->customer_type = $request->type_customer;
        $user->status = 0;
        $user->save();
        return redirect()->intended('auth/login');
    }

}
