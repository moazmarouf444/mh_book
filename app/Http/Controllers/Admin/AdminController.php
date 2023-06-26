<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\Update;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\Role;
use App\Traits\Report;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AdminController extends Controller {
  use ResponseTrait;

  public function index() {
    $admins = Admin::latest()->get();
    return view('admin.admins.index', compact('admins'));
  }

  public function create() {
    $roles = Role::latest()->get();
    return view('admin.admins.create', compact('roles'));
  }

  public function store(Create $request) {
    Admin::create($request->validated());
    Report::addToLog( awtTrans('اضافه مدير'));
    return $this->successOtherData(['url' => route('admin.admins.index')]);
  }

  public function edit($id) {
    $admin = Admin::findOrFail($id);
    $roles = Role::latest()->get();
    return view('admin.admins.edit', ['admin' => $admin, 'roles' => $roles]);
  }

  public function update($id, Update $request) {
    $admin = Admin::findOrFail($id);
    $admin->update($request->validated());
    Report::addToLog( awtTrans('تعديل مدير'));
    return $this->successOtherData(['url' => route('admin.admins.index')]);
  }

  public function show($id) {
    $admin = Admin::findOrFail($id);
    $roles = Role::latest()->get();
    return view('admin.admins.show', ['admin' => $admin, 'roles' => $roles]);
  }

  public function destroy($id) {
    if (1 == $id) {
      return;
    }

    Admin::findOrFail($id)->delete();
    Report::addToLog(awtTrans('حذف مدير'));
    return $this->successOtherData(['id' => $id]);

  }

  public function destroyAll(Request $request) {
    $requestIds = array_column(json_decode($request->data), 'id');
    Admin::whereIn('id', $requestIds)->where('id', '!=', 1)->delete();
    Report::addToLog(awtTrans('حذف العديد من المديرين'));
    return response()->json('success');
    //return response()->json('failed');
  }

  public function notifications() {
      $superAdmin = Admin::find(1);
      $superAdmin->unreadNotifications->markAsRead();
      $notifications = $superAdmin->notifications;
//      $notifications = Notification::where('notifiable_type', 'App\Models\Admin')->get();
      return view('admin.admins.notifications', compact('notifications'));
  }

  public function deleteNotifications(Request $request) {
    $requestIds = array_column(json_decode($request->data), 'id');
    auth('admin')->user()->notifications()->whereIn('id', $requestIds)->delete();
    return $this->successMsg();
  }
}
