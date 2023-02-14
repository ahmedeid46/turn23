<?php

namespace App\Http\Controllers\seller\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellerRequest;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\SellerCat;
use App\Models\SubCat;
use App\Traits\NavBar;
use App\Traits\UploadFiles;
use Hashids\Hashids;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use UploadFiles,NavBar;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //section construct
    public function __construct()
    {
        $this->middleware('guest:seller');
    }
    // section show register
    public function showRegister()
    {
        $data['catHashids'] = new Hashids(env('app_name').'cats',7);
        $data['subCatHashids'] = new Hashids(env('app_name').'subCats',8);
        $data['navbar_menu'] = $this->customer();
        $data['cats'] = Cat::with('subCat')->get();
        return view('seller.auth.register')->with($data);
    }
    // section register
    protected function register(StoreSellerRequest $request)
    {
        $validated = $request->validated();
        $user = new seller;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->linkedin = $request->linkedin;
        // Upload Files
        foreach ($request->cat as $cat) {
            switch ($cat) {
                case 2:
                    return redirect()->back()->with('soon_cat', 'will added this Category Soon');
                case 3:
                case 1:
                    $user->registration_certificate = $this->sellerUploadFile($request->name, $request->registration_certificate, 'registration');
                    $user->tax_card = $this->sellerUploadFile($request->name, $request->tax_card, 'tax');
                    $user->vat_cert = $this->sellerUploadFile($request->name, $request->vat_cert, 'vat');
                    $user->invoice = $this->sellerUploadFile($request->name, $request->invoice, 'invoice');
                    $user->delgation = $this->sellerUploadFile($request->name, $request->delegation, 'delegation');
                    $user->reference_list = $this->sellerUploadFile($request->name, $request->reference_list, 'reference');
                    $user->website = $request->website;
                    break;
                case 4:
                    $user->cv = $this->customerUploadFile($request->name, $request->cv, 'cv');
                    $user->docs = json_encode($this->sellerUploadmultiFile($request->name,$request->docs,'docs'));
                    break;
                case 5:
                    $user->docs = json_encode($this->sellerUploadmultiFile($request->name,$request->docs,'docs'));
                    $user->type_cource = $request->on_of;
                    $user->price = $request->price;
                    $user->price_type = $request->price_type;
                    $user->Specialization = $request->Specialization;
                    $user->min_num_trainees = $request->min_num_trainees;
                    $user->start_date = $request->start_date;
                    $user->end_date = $request->end_date;
                    break;
            }
        }
        $user->cat_id = json_encode($request->cat);
        $user->save();

        return redirect()->route('seller.show.login')->with('registerSuccess','Successfully Register');
    }

}
