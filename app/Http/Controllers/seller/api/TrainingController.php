<?php

namespace App\Http\Controllers\seller\api;

use App\Http\Controllers\Controller;
use App\Models\GroupForTraining;
use App\Models\Trining;
use App\Traits\APITrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    use APITrait;
    //
    function index(){
        $trainings = GroupForTraining::with('training')->where('seller_id',auth('seller-api')->user()->getAuthIdentifier())->get();
        $newtrainings = [];
        foreach ($trainings as $training){
            $newtraining = [];
            $newtraining['id'] = $training->id;
            $newtraining['name'] = $training->name;
            $newtraining['date'] = $training->date;
            $newtraining['status'] = $training->status;
            $newtraining['num_session'] = $training->num_session;
            $newtraining['num_compete_session'] = $training->num_complete_session;
            $newtraining['average_rate'] = $training->num_related == 0?0:$training->sum_related/$training->num_related;
            foreach ($training->training as $item){
                if ($item->training->type_course == 2){
                    $newtraining['trainee_count'] = $item->training->trainees_num;
                    $newtraining['trining_type']= $item->training->type_course == 1?"online":"offline";
                }else{
                    $newtraining['trainee_count'] = count($training->training);
                    $newtraining['trining_type'] = auth('seller-api')->user()->type_course == 1?"online":"offline";
                }


            }
            $newtrainings[] = $newtraining;
        }
        $data['trainings'] =$newtrainings ;
        return $this->returnSuccess('',$data,200);
    }
    function trainingStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'group_id'=>'required',
            'status'=>'required'
        ]);
        if($validator->fails()){
            return $this->returnError($validator->errors()->all(),'400');
        }
        $training =  GroupForTraining::find($request->group_id);
        $training->status = $request->status;
        $training->save();
        if ($request->status == 1){
            return $this->returnSuccess(['accepted successfully']);
        }
        $this->returnSuccess(['refuse successfully']);
    }
}
