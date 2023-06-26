<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaperSize\Store;
use App\Http\Requests\Admin\PaperSize\Update;
use App\Models\PaperSize;
use App\Traits\Report;
use Illuminate\Http\Request;

class PaperSizeController extends Controller
{
    public function index()
    {
        $papers = PaperSize::latest()->get();
        return view('admin.paper_sizes.index', compact('papers'));
    }

    public function create()
    {
        return view('admin.paper_sizes.create');
    }

    public function store(Store $request)
    {
        PaperSize::create($request->validated());
        Report::addToLog('اضافه حجم ورق جديد');
        return response()->json(['url' => route('admin.paper.size.index')]);
    }

    public function edit($paper_id)
    {
        $paper_id = PaperSize::findOrFail($paper_id);
        return view('admin.paper_sizes.edit', ['paper' => $paper_id]);
    }

    public function update(Update $request, $paper_id)
    {
        PaperSize::findOrFail($paper_id)->update($request->validated());
        Report::addToLog('  تعديل حجم ورق');
        return response()->json(['url' => route('admin.paper.size.index')]);
    }

    public function destroy($paper_id)
    {
        PaperSize::findOrFail($paper_id)->delete();
        Report::addToLog('  حذف حجم ورق');
        return response()->json(['id' => $paper_id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PaperSize::WhereIn('id', $ids)->delete()) {
            Report::addToLog('حذف العديد من احجام الورق');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }


}
