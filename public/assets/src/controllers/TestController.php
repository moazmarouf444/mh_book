<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ModelName;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ModelName\UpdateRequest;
use App\Http\Requests\ModelName\StoreRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\pluralCompactNameExport;

class ModelNameController extends Controller
{
    use HasResponse;
    public function index()
    {
        $pluralVariable = ModelName::all();

        return view('admin.viewSource.index', compact('pluralCompactName'));
    }

    public function create()
    {
        return view('admin.viewSource.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        ModelName::create($data);

        auth()->user()->saveReport(__('dashboard.__pluralName__.create___snake_single_name__'));

        return redirect()->route('admin.routeName.index')->with('success', __('dashboard.alerts.created_successfully'));
    }

    public function show(ModelName $singularVariable)
    {
        return view('admin.viewSource.show', compact('singularCompactName'));
    }

    public function edit(ModelName $singularVariable)
    {
        return view('admin.viewSource.edit', compact('singularCompactName'));
    }

    public function update(UpdateRequest $request, ModelName $singularVariable)
    {
        $data = $request->validated();

        $singularVariable->update($data);

        auth()->user()->saveReport(__('dashboard.__pluralName__.edit___snake_single_name__'));

        return redirect()->route('admin.viewSource.index')->with('success', trans('dashboard.alerts.updated_successfully'));
    }

    public function destroy(ModelName $singularVariable)
    {
        $singularVariable->delete();

        auth()->user()->saveReport(__('dashboard.__pluralName__.delete___snake_single_name__'));

        return $this->successReturn(__('dashboard.alerts.deleted_successfully'));
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        $pluralVariable = ModelName::find($ids);

        ModelName::destroy($pluralVariable);

        auth()->user()->saveReport(__('dashboard.__pluralName__.delete___snake_single_name__'));

        return $this->successReturn(__('dashboard.alerts.deleted_successfully'));
    }

    public function downloadAllpluralCompactName()
    {
        return Excel::download( new pluralCompactNameExport(), 'all-pluralCompactName.xlsx');
    }

}
