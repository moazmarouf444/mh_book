<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\IntroHowWorks\Update;
use App\Traits\Report;
use App\Models\IntroHowWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroHowWorks\Store;

class IntroHowWorkController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroHowWork::latest()->get() ;
        return view('admin.introhowworks.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.introhowworks.create');
    }
    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroHowWork::create($request->validated() + (['title' => ['ar' => $request->title_ar , 'en' => $request->title_en]])) ;
        Report::addToLog(awtTrans('  اضافه طريقة عمل لقسم كيفيه عمل الموقع التعريفي')) ;
        return response()->json(['url' => route('admin.introhowworks.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroHowWork::findOrFail($id);
        return view('admin.introhowworks.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Update $request, $id)
    {
        IntroHowWork::findOrFail($id)->update($request->validated() + (['title' => ['ar' => $request->title_ar , 'en' => $request->title_en]]));
        Report::addToLog(awtTrans('  تعديل طريقة عمل لقسم كيفيه عمل الموقع التعريفي')) ;
        return response()->json(['url' => route('admin.introhowworks.index')]);
    }

    /*************** show *************************************/
    public function show($id)
    {
        $row = IntroHowWork::findOrFail($id);
        return view('admin.introhowworks.show' , ['row' => $row]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroHowWork::findOrFail($id)->delete();
        Report::addToLog(awtTrans('  حذف طريقة عمل لقسم كيفيه عمل الموقع التعريفي')) ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroHowWork::whereIn('id' , $ids)->delete($ids)) {
            Report::addToLog(awtTrans('  حذف العديد من طرق العمل لقسم كيفيه عمل الموقع التعريفي'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
