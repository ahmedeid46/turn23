<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    function index(){
        $customercount = Customer::count();
        $sellercount = Seller::count();
        $data['total_user'] = $customercount + $sellercount;
        $data['seller_count'] = $sellercount;
        $data['customer_count']  = $customercount;
        $data['pending_count'] = Customer::where('status',0)->count() + Seller::where('status',0)->count();
        return view('admin.page.users')->with($data);
    }

    function seller(){
        $users = Seller::paginate(12);
        foreach ($users as $user){
            $cats = Cat::find(json_decode($user->cat_id));
            $user['allFileStatus'] = 0;
            foreach ($cats as $cat){
                switch ($cat->id){
                    case 1:
                    case 2:
                    case 3:
                        if ($user->reg_cert_status  == 1 &&
                            $user->tax_card_status  == 1 &&
                            $user->vat_cert_status  == 1 &&
                            $user->delgation_status == 1 &&
                            $user->reference_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                    case 4:
                        if ($user->cv_status  == 1 &&
                            $user->docs_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                    case 5:
                        if ($user->docs_status == 1){
                            $user['allFileStatus'] = 1;
                        }
                        break;
                }
            }
            $user['cats'] = $cats;
        }
        $data['users']=$users;

        return view('admin.page.users-seller')->with($data);
    }
    function sellerDetails($id){
        $data['user'] = Seller::find($id);
        return view('admin.page.users-seller-details')->with($data);
    }
    function deleteSeller(Request $request){
        $user = Seller::find($request->id);
        if ($user->status !=1){
            $user->status = 1;
        }else{
            $user->status = -1;
        }
        $user->save();
        return redirect()->back();
    }
    function customer(){
        $data['users'] = Customer::paginate(12);
        return view('admin.page.users-customer')->with($data);
    }
    function customerDetails($id){
        $data['user'] = Customer::with('service')->find($id);
        return view('admin.page.users-customer-details')->with($data);
    }
    function deleteCustomer(Request $request){
        $user = Customer::find($request->id);
        if ($user->status !=1){
            $user->status = 1;
        }else{
            $user->status = -1;
        }
        $user->save();
        return redirect()->back();
    }
}
