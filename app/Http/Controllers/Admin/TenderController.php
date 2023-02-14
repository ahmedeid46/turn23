<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChPriceTender;
use App\Models\ChTender;
use App\Models\IndPriceTender;
use App\Models\IndTender;
use App\Traits\UploadFiles;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    //
    use UploadFiles;
    function chemical_type(){
        return view('admin.page.order_chemical_type');
    }
    function chemical(){
        $data['tenders'] = ChTender::with('customer')->where('status','!=',6)->get();
        return view('admin.page.tender.chemical_tender')->with($data);

    }
    function chemical_details($id){
        $data['tender'] = ChTender::with('customer')->find($id);
        $data['prices'] = ChPriceTender::with('seller')->where('tender_id',$id)->get();
        return view('admin.page.tender.chemical_tender_details')->with($data);

    }
    function chemical_accept(Request $request){
        $this->validate($request,[
            'tender_id' =>'required|exists:ch_tenders,id',
            'file' => 'required'
        ]);
        $tender = ChTender::find($request->tender_id);
        $tender->status = 1;
        $tender->admin_tender_file = $this->orderUploadFile('tender_ind',$request->file,'tender');
        $tender->save();
        return redirect()->back()->with('success','Tender Accept Successfully');
    }
    function chemical_price_accept(Request $request){
        $this->validate($request,[
            'tender_id' =>'required',
            'file' => 'required'
        ]);
        $tender = ChPriceTender::find($request->tender_id);
        $tender->admin_file = $this->orderUploadFile('tender_ch',$request->file,'tender');
        $tender->status = 1;
        $tender->save();
        return redirect()->back()->with('success','Price Accept Successfully');
    }
    function chemical_status(Request $request){
        $this->validate($request,[
            'tender_id' =>'required|exists:ch_tenders,id',
            'status' => 'required|min:0|max:6'
        ]);
        $tender = ChTender::find($request->tender_id);
        $tender->status = $request->status;
        $tender->save();
        return redirect()->back()->with('success','Tender Status Changed Successfully');

    }

    function industrial_type(){
        return view('admin.page.industrial');
    }
    function industrial(){
        $data['tenders'] = IndTender::with('customer')->where('status','!=',6)->get();
        return view('admin.page.tender.industrial_tender')->with($data);
    }
    function industrial_details($id){
        $data['tender'] = IndTender::with('customer')->find($id);
        $data['prices'] = IndPriceTender::with('seller')->where('tender_id',$id)->get();
        return view('admin.page.tender.industrial_tender_details')->with($data);
    }
    function industrial_accept(Request $request){
        $this->validate($request,[
            'tender_id' =>'required',
            'file' => 'required'
        ]);
        $tender = IndTender::find($request->tender_id);
        $tender->admin_tender_file = $this->orderUploadFile('tender_ind_',$request->file,'tender');
        $tender->status = 1;
        $tender->save();
        return redirect()->back()->with('success','Tender Accept Successfully');
    }
    function industrial_price_accept(Request $request){
        $this->validate($request,[
            'tender_id' =>'required',
            'file' => 'required'
        ]);
        $tender = IndPriceTender::find($request->tender_id);
        $tender->admin_file = $this->orderUploadFile('tender_ind_price',$request->file,'tender');
        $tender->status = 1;
        $tender->save();
        return redirect()->back()->with('success','Price Accept Successfully');
    }
    function industrial_status(Request $request){
        $this->validate($request,[
            'tender_id' =>'required|exists:ind_tenders,id',
            'status' => 'required|min:0|max:6'
        ]);
        $tender = IndTender::find($request->tender_id);
        $tender->status = $request->status;
        $tender->save();
        return redirect()->back()->with('success','Tender Status Changed Successfully');

    }
}
