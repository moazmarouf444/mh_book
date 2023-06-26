<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cover\Store;
use App\Http\Requests\Admin\Cover\Update;
use App\Models\Cover;
use App\Traits\Report;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    public function index()
    {
        $covers = Cover::latest()->get();
        return view('admin.covers.index', compact('covers'));
    }

    public function show($cover_id)
    {
        $cover_id = Cover::findOrFail($cover_id);
        return view('admin.covers.show', ['row' => $cover_id]);
    }


    public function create()
    {
        return view('admin.covers.create');
    }
    public function store(Store $request)
    {
        Cover::create($request->validated());
        Report::addToLog(awtTrans('اضاف غلاف'));
        return response()->json(['url' => route('admin.cover.index')]);
    }

    public function edit($cover_id)
    {
        $cover_id = Cover::findOrFail($cover_id);
        return view('admin.covers.edit', ['cover' => $cover_id]);
    }


    public function update(Update $request, $cover_id)
    {
        Cover::findOrFail($cover_id)->update($request->validated());
        Report::addToLog(awtTrans('  تعديل غلاف'));
        return response()->json(['url' => route('admin.cover.index')]);
    }


    public function destroy($cover_id)
    {
        Cover::findOrFail($cover_id)->delete();
        Report::addToLog(awtTrans('  حذف غلاف'));
        return response()->json(['id' => $cover_id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Cover::WhereIn('id', $ids)->delete()) {
            Report::addToLog(awtTrans('حذف العديد من الاغلفه'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function viewCover($id){
        $cover = Cover::findOrFail($id);
        return view('admin.covers.view-cover')->with(['cover' => $cover]);
    }

}
