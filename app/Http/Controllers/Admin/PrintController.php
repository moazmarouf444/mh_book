<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Printing\Store;
use App\Http\Requests\Admin\Printing\Update;
use App\Models\Printing;
use Illuminate\Http\Request;
use App\Traits\Report;
class PrintController extends Controller
{
    public function index(){
        $printings= Printing::latest()->get();
        return view('admin.printings.index', compact('printings'));
    }


    public function show($print_id)
    {
        $print = Printing::findOrFail($print_id);
        return view('admin.printings.show' ,compact('print'));
    }

    public function create(){
        return view('admin.printings.create');
    }
    public function store(Store $request){
        Printing::create($request->validated());
        Report::addToLog('اضاف نوع طباعه') ;
        return response()->json(['url' => route('admin.print.type.index')]);
    }

    public function edit($print_id)
    {
        $print = Printing::findOrFail($print_id);
        return view('admin.printings.edit',compact('print'));
    }
    public function update(Update $request, $print_id)
    {
        Printing::findOrFail($print_id)->update($request->validated());
        Report::addToLog('  تعديل نوع طباعه');
        return response()->json(['url' => route('admin.print.type.index')]);
    }


    public function destroy($print_id)
    {
        Printing::findOrFail($print_id)->delete();
        Report::addToLog('  حذف نوع طباعه') ;
        return response()->json(['id' =>$print_id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Printing::WhereIn('id',$ids)->delete()) {
            Report::addToLog('حذف العديد من الاغلفه');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }


}
