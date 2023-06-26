<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Socials\Update;
use App\Models\Social;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ISocial;
use App\Http\Requests\Admin\Socials\Store;

class SocialController extends Controller
{
    use Report ;

    public function index()
    {
        $socials = Social::get();
        return view('admin.socials.index', compact('socials'));
    }


    public function create()
    {
        return view('admin.socials.create');
    }
    
    public function store(Store $request)
    {
        Social::create($request->validated());
        Report::addToLog(awtTrans('  اضافه وسيلة تواصل'));
        return response()->json(['url' => route('admin.socials.index')]);
    }

    public function edit($social_id)
    {
        $social = Social::findOrFail($social_id);
        return view('admin.socials.edit' , ['social' => $social]);
    }

    public function update(Update $request, $id)
    {
        Social::findOrFail($id)->update($request->validated());
        Report::addToLog(awtTrans('  تعديل وسيلة تواصل')) ;
        return response()->json(['url' => route('admin.socials.index')]);
    }

    public function show($social_id)
    {
        $social = Social::findOrFail($social_id);
        return view('admin.socials.show' , ['social' => $social]);
    }
    public function destroy($social_id)
    {
        Social::findOrFail($social_id)->delete();
        Report::addToLog(awtTrans('حذف وسيلة تواصل'));
        return response()->json(['id' =>$social_id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Social::whereIn('id' , $ids)->delete($ids)) {
            Report::addToLog(awtTrans('حذف العديد من وسائل التواصل'));
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
