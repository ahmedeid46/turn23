<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupForTraining;
use App\Models\TrainingGroup;
use App\Models\Trining;
use Exception;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //
    function createGroup(Request $request){
        $this->validate($request, [
            'name' =>'required',
            'date' =>'required',
            'seller' => 'required|exists:sellers,id',
            'training_ids' =>'required',
//            'training_ids.*' =>'required|exists:trinings,id',
        ]);
        try {
            $group = new GroupForTraining;
            $group->start_date = $request->start_date;
            $group->end_date = $request->end_date;
            $group->num_session = $request->num_session;
            $group->location = $request->location;
            $group->seller_id = $request->seller;
            $group->save();
            foreach ($request->training_ids as $training_id){
                $training = new TrainingGroup;
                $training->group_id = $group->id;
                $training->training_id = $training_id;
                $training->save();
                $row = Trining::find($training_id);
                $row->status = 1;
                $row->save();
            }
            return redirect()->back()->with('successful','Training Group Added Successfully');
        }catch (Exception $e){
            return redirect()->back()->with('failed','Training Group Not Added');
        }

    }
    function edit(Request $request){
        $this->validate($request, [
            'group_id' =>'required|exists:group_for_trainings,id',
            'name' =>'required',
            'date' =>'required',

        ]);
        try {
            $group = GroupForTraining::find($request->group_id);
            $group->name = $request->name;
            $group->date = $request->date;
            $group->save();
            return redirect()->back()->with('successful','Training Group Update Successfully');
        }catch (Exception $e){
            return redirect()->back()->with('failed','Training Group Not Update');
        }
    }
    function delete(Request $request){
        $this->validate($request, [
            'group_id' =>'required|exists:group_for_trainings,id',

        ]);
        try {
            $group = GroupForTraining::find($request->group_id);
            $trainings = TrainingGroup::where('group_id',$request->group_id)->get();
            foreach ($trainings as $trainee){
                $row = Trining::find($trainee->trainee_id);
                $row->status = 0;
                $row->save();
            }
            $trainings->delete();
            $group->delete();
            return redirect()->back()->with('successful','Training Group Delete Successfully');
        }catch (Exception $e){
            return redirect()->back()->with('failed','Training Group Not Delete');
        }
    }
    function trainings(){
        return view('admin.page.all-training');
    }
    function training_request(){
        $data['trainings'] = Trining::with('customer', 'trainer')->where('status',0)->get();
        //return $data;
        return view('admin.page.training', $data);
    }
}
