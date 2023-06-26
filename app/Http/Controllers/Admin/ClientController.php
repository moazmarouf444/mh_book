<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\AddEditClientRequest;
use App\Jobs\BlockUser;
use App\Jobs\NotifyUser;
use App\Models\User;
use App\Traits\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

class ClientController extends Controller {

  public function index(Request $request) {
    if ($request->ajax()) {
      return $this->prepareDatatable($request);
    }

    $rows = User::get();
    return view('admin.clients.index', compact('rows'));
  }

  public function prepareDatatable($data = []) {
    $rows = User::query();

    if (!is_null($data['min']) && !is_null($data['max'])) {
      $rows = $rows->whereBetween('created_at', [$data['min'], $data['max']]);
    }

    return DataTables::of($rows)
      ->addColumn('id', function ($row) {
        return (string) view('admin.shared.datatables.checkbox', compact('row'));
      })
      ->addColumn('created_at', function ($row) {
        return '<td>' . Carbon::parse($row->created_at)->format('d/m/Y') . '</td>';
      })
      ->addColumn('image', function ($row) {
        return '<td><a target="_blank" href="' . $row->avatar . '"><img src="' . $row->avatar . '" width="50px" height="50px" alt=""></a></td>';
      })
      ->addColumn('phone', function ($row) {
        return '<td><a href="tel:' . $row->phone . '">' . $row->phone . '</a></td>';
      })
      ->addColumn('email', function ($row) {
        return '<td><a href="mailto:' . $row->email . '">' . $row->email . '</a></td>';
      })
      ->addColumn('block', function ($row) {
        return (string) view('admin.shared.datatables.user.block', compact('row'));
      })
      ->addColumn('activate', function ($row) {
        return (string) view('admin.shared.datatables.user.block', compact('row'));
      })
      ->addColumn('controls', function ($row) {
        return (string) view('admin.shared.datatables.user.controls', compact('row'));
      })
      ->rawColumns(['id', 'created_at', 'image', 'phone', 'email', 'block', 'activate', 'controls'])
      ->make(true);
  }

  /***************************  get active clients  **************************/
  public function active(Request $request) {
    $rows = User::where(['active' => true])->get();
    return view('admin.clients.index', compact('rows'));
  }

  /***************************  get not active clients  **************************/
  public function notActive() {
    $rows = User::where(['active' => false])->get();
    return view('admin.clients.index', compact('rows'));
  }

  /***************************  get active clients  **************************/
  public function block() {
    $rows = User::where(['is_blocked' => true])->get();
    return view('admin.clients.index', compact('rows'));
  }

  /***************************  get active clients  **************************/
  public function notBlock() {
    $rows = User::where(['is_blocked' => false])->get();
    return view('admin.clients.index', compact('rows'));
  }

  /***************************  store  **************************/
  public function create() {
    return view('admin.clients.create');
  }

  /***************************  store client **************************/
  public function store(AddEditClientRequest $request) {
    User::create($request->all());
    Report::addToLog(awtTrans('اضافه مستخدم'));
    return response()->json(['url' => route('admin.clients.index')]);
  }

  /***************************  store  **************************/
  public function edit($id) {
    $row = User::findOrFail($id);
    return view('admin.clients.edit', ['row' => $row]);
  }

  /***************************  update client  **************************/
  public function update(AddEditClientRequest $request, $id) {
//      dd($request->all());
    $user = User::findOrFail($id)->update($request->validated());
    Report::addToLog(awtTrans('تعديل مستخدم'));
    return response()->json(['url' => route('admin.clients.index')]);
  }

  /*************** show *************************************/
  public function show($id) {
    $row = User::findOrFail($id);
    return view('admin.clients.show', ['row' => $row]);
  }

  /***************************  delete client **************************/
  public function destroy($id) {
    $user = User::findOrFail($id)->delete();
    Report::addToLog('  حذف مستخدم');
    return response()->json(['id' => $id]);
  }

  public function blockUser($id) {
    $user = User::findOrFail($id);
    dispatch(new BlockUser($user));
    return redirect()->back()->with('success', awtTrans('تم حظر المستخدم بنجاح'));
  }

  public function notify(Request $request) {
    if ('all' == $request->id) {
      $clients = User::get();
    } else {
      $clients = User::findOrFail($request->id);
    }
//    dd(new NotifyUser($clients, $request, $request->type));
      dispatch(new NotifyUser($clients, $request, $request->type));
      return response()->json();
  }

  public function destroyAll(Request $request) {
    $requestIds = json_decode($request->data);

    foreach ($requestIds as $id) {
      $ids[] = $id->id;
    }
    if (User::whereIn('id', $ids)->delete()) {
      Report::addToLog(awtTrans('حذف العديد من المستخدمين'));
      return response()->json('success');
    } else {
      return response()->json('failed');
    }
  }
}
