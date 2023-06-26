<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Frame\Store;
use App\Http\Requests\Admin\Frame\Update;
use App\Models\Frame;
use App\Traits\Report;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    public function index(){
        $frames = Frame::latest()->get();
        return view('admin.frames.index', compact('frames'));
    }

    public function show($frame_id)
    {
        $frame = Frame::findOrFail($frame_id);
        return view('admin.frames.show' ,compact('frame'));
    }

    public function create(){
        return view('admin.frames.create');
    }
    public function store(Store $request){
        Frame::create($request->validated());
        Report::addToLog(awtTrans('اضاف اطار'));
        return response()->json(['url' => route('admin.frames.index')]);
    }
    public function edit($frame_id)
    {
        $frame = Frame::findOrFail($frame_id);
        return view('admin.frames.edit',compact('frame'));
    }
    public function update(Update $request, $id)
    {
        Frame::findOrFail($id)->update($request->validated());
        Report::addToLog(awtTrans('  تعديل اطار'));
        return response()->json(['url' => route('admin.frames.index')]);
    }


    public function destroy($frame_id)
    {
         Frame::findOrFail($frame_id)->delete();
//         dd($frame_id);
        Report::addToLog(awtTrans('  حذف اطار')) ;
        return response()->json(['id' =>$frame_id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Frame::WhereIn('id',$ids)->delete()) {
            Report::addToLog(awtTrans('حذف العديد من الاغلفه'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

}
