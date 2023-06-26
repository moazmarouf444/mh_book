<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\Report;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    /***************************  get all   **************************/
    public function show($message_id)
    {
        $message= Message::findOrFail($message_id);
        return view('admin.messages.show', compact('message'));
    }




    /***************************  delete  **************************/
    public function destroy($message_id)
    {
        Message::findOrFail($message_id)->delete();
        Report::addToLog('حذف رساله') ;
        return response()->json(['id' =>$message_id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Message::whereIn('id' , $ids)->delete()) {
            Report::addToLog('حذف العديد من الرسائل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
