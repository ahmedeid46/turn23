<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;


class SearchController extends Controller{
    // Seller Search Section
    function SearchSeller(Request $request){
        if($request->ajax())
        {
            $output="";
            $users = Seller::with('sellerCat')->where('name','LIKE','%'.$request->search."%")->orderByDesc('id')->with('cat')->get();
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
            if($users)
            {
                foreach ($users as $key => $user) {
                   if ($user->allFileStatus != 1){
                     $output .= '
                     <tr>
                            <td>'.$user->name.'</td>
                            <td>';
                     foreach ($user->cats as $cat) {
                         $output .= $cat->title.', ';
                             }
                       $output .='</td>

                        <td>
                            <span class="badge bg-light-warning">pending</span>
                        </td>
                        <td>
                        <a href="'. route('admin.permission.register.seller.details',$user->id).'">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a></td>';

                   }
                }
                }
                return Response($output);
            }

    }
    function FilterSeller(Request $request){
        if($request->ajax())
        {
            $output="";
            $users = Seller::with('sellerCat')->where('cat_id','LIKE','%'.$request->search."%")->orderByDesc('id')->with('cat')->get();
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
            if($users)
            {
                foreach ($users as $key => $user) {
                    if ($user->allFileStatus != 1){
                        $output .= '
                     <tr>
                            <td>'.$user->name.'</td>
                            <td>';
                        foreach ($user->cats as $cat) {
                            $output .= $cat->title.', ';
                        }
                        $output .='</td>

                        <td>
                                                                    <span class="badge bg-light-warning">pending</span>

</td>
                        <td>
                        <a href="'. route('admin.permission.register.seller.details',$user->id).'">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a></td>';

                    }
                }
            }
            return Response($output);
        }

    }

    // Customer Search Section
    function SearchCustomer(Request $request){
        if($request->ajax())
        {
            $output="";
            $users = Customer::where('name','LIKE','%'.$request->search."%")->orderByDesc('id')->get();
            foreach ($users as $user){
                $user['allFileStatus'] = 0;
                switch ($user->customer_type){
                        case 2:
                            if ($user->reg_cert_status  == 1 &&
                                $user->tax_card_status  == 1 &&
                                $user->vat_cert_status  == 1 &&
                                $user->delgation_status == 1 &&
                                $user->reference_status == 1){
                                $user['allFileStatus'] = 1;
                            }
                            break;
                        default:
                                $user['allFileStatus'] = 1;
                            break;
                    }
            }
            if($users)
            {
                foreach ($users as $key => $user) {
                    if ($user->allFileStatus != 1){
                        $output .= '
                     <tr>
                            <td>'.$user->name.'</td>
                            <td>';
                        if ($user->customer_type  == 1) {
                            $output .= 'individual';
                        }else{
                            $output .= 'Company';
                        }
                        $output .='</td>

                        <td>
                            <span class="badge bg-light-warning">pending</span>
                        </td>
                        <td>
                        <a href="'.route('admin.permission.register.customer.details',$user->id).'">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a></td>';

                    }
                }
            }
            return Response($output);
        }

    }

    function locationCheckGroup(Request $request){
        if($request->ajax())
        {
            $output="";
            $user = Seller::find($request->id);
            if($user->type_cource == 0 && $user->work_space == 0){
                $output.= '<label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control"/>';
            }
            return Response($output);
        }

    }

}
