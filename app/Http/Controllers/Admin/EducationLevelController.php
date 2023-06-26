<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationLevel\Store;
use App\Http\Requests\Admin\EducationLevel\Update;
use App\Models\EducationLevel;
use App\Traits\Report;
use Illuminate\Http\Request;

class EducationLevelController extends Controller
{
    public function index()
    {
        $educationLevels = EducationLevel::latest()->get();
        return view('admin.education_levels.index', compact('educationLevels'));
    }

    public function show($education_level_id)
    {
        $educationLevel = EducationLevel::findOrFail($education_level_id);
        return view('admin.education_levels.show', ['educationLevel' => $educationLevel]);
    }

    public function create()
    {
        return view('admin.education_levels.create');
    }

    public function store(Store $request)
    {
        EducationLevel::create($request->validated());
        Report::addToLog(awtTrans('اضافه مرحله دراسيه'));
        return response()->json(['url' => route('admin.education.level.index')]);
    }

    public function edit($education_level_id)
    {
        $educationLevel= EducationLevel::findOrFail($education_level_id);
        return view('admin.education_levels.edit', ['educationLevel' => $educationLevel]);
    }

    public function update(Update $request, $education_level_id)
    {
        EducationLevel::findOrFail($education_level_id)->update($request->validated());
        Report::addToLog(awtTrans('  تعديل مرحله دراسيه'));
        return response()->json(['url' => route('admin.education.level.index')]);
    }

    public function destroy($education_level_id)
    {
        EducationLevel::findOrFail($education_level_id)->delete();
        Report::addToLog(awtTrans('  حذف مرحله دراسيه'));
        return response()->json(['id' => $education_level_id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (EducationLevel::WhereIn('id', $ids)->delete()) {
            Report::addToLog(awtTrans('حذف العديد من المراحل الدراسيه'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
