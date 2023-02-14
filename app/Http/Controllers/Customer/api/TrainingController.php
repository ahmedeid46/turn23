<?php

namespace App\Http\Controllers\Customer\api;

use App\Http\Controllers\Controller;
use App\Models\GroupForTraining;
use App\Models\Seller;
use App\Models\Trining;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    use APITrait;
    //
    function index(){
        $data['trainers'] = Seller::where('cat_id',5)->get();
        return $this->returnSuccess('',$data,200);
    }
    function request(Request $request){
        $validated = Validator::make($request->all(), [
            'seller_id'=>'required|exists:sellers,id',
            'type_user'=>'required',

        ]);
        if($validated->fails()){
            return $this->returnError($validated->errors()->all(),'400');
        }
        $training = new Trining;
        $training->seller_id = $request->seller_id;
        $training->customer_id = auth('customer-api')->user()->getAuthIdentifier();
        $training->type_course = $request->type_user;
        if ($request->type_user == 2){
            $validated = Validator::make($request->all(), [
                'trainees_num'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
                'training_type'=>'required'

            ]);
            if($validated->fails()){
                return $this->returnError($validated->errors()->all(),'400');
            }
            $training->trainees_num = $request->trainees_num;
            $training->start_date = $request->start_date;
            $training->end_date = $request->end_date;
            $training->trining_type = $request->training_type;
        }
        $training->save();
        return $this->returnSuccess(['Request Trainer Successfully']);
    }
    function trainingRequested(){
        $trainings = Trining::with('trainer')->with('groups')->where('customer_id',auth('customer-api')->user()->getAuthIdentifier())->get();
        foreach ($trainings as $training){
            $training['type_user'] = $training['type_course'] == 2?'Company':'Individual';
            $training['training_type'] = $training['trining_type'] == 0?'Offline':($training['trining_type'] == 1?"Online":null);
        }
        $data['trainings'] = $trainings;
        return $this->returnSuccess('',$data,200);
    }
}
