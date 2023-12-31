<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Traits\Report;

use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Complaint::latest()->get();
        return view('admin.complaints.index', compact('rows'));
    }

    /***************************  get all   **************************/
    public function show($id)
    {
        $row = Complaint::findOrFail($id);
        return view('admin.complaints.show', compact('row'));
    }


    public function replay(Request $request ,$id)
    {
        $complaint = Complaint::findOrFail($id);
        auth('admin')->user()->replays()->create(['replay' => $request->replay , 'complaint_id' => $id]);
        return response()->json(['url' => route('admin.all_complaints')]) ;
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Complaint::findOrFail($id)->delete();
        Report::addToLog(awtTrans('  حذف تقرير')) ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Complaint::whereIn('id' , $ids)->delete()) {
            Report::addToLog(awtTrans('  حذف العديد من الشكاوي والمقترحات')) ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
