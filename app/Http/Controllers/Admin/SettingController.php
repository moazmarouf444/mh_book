<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Settings\Update;
use Image ;
use App\Traits\Report;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    /***************************  get all settings  **************************/
    public function index(){
        $data =  SettingService::appInformations(SiteSetting::pluck('value', 'key'));
        return view('admin.settings.index',compact('data'));
    }


    /***************************  update settings  **************************/
    public function update(Update $request){
//        dd($request->all());

        foreach ( $request->all() as $key => $val )
//            dd($request->all());
            if (in_array($key , ['logo' , 'fav_icon' , 'default_user' , 'intro_loader' , 'intro_logo'  ,'about_image_2' , 'about_image_1' , 'login_background'])) {
                $img           = Image::make($val);
                $name          = time() . '_' . rand(1111, 9999) . '.' . $val->getClientOriginalExtension();

                if($key == 'default_user'){
                    $thumbsPath    = 'storage/images/users';
                }else if ($key == 'no_data') {
                    $thumbsPath    = 'storage/images/';
                }
//                else{
                    $thumbsPath    = 'storage/images/settings';
//                }
                SiteSetting::where( 'key', $key ) -> update( [ 'value' => $name ] );

                $img->save($thumbsPath . '/' . $name);
            }
            else if($val){
                SiteSetting::where( 'key', $key ) -> update( [ 'value' => $val ] );
            }
        Report::addToLog('تعديل الاعدادت') ;
        return back()->with('success','تم الحفظ');
    }


    /***************************  message all  **************************/
    public function messageAll(Request $request,$type){

        $this->userRepo->messageAll($request->all(),$type);
        return back()->with('success','تم الارسال');
    }

    /***************************  message one  **************************/
    public function messageOne(Request $request,$type){

        $this->userRepo->messageOne($request->all(),$type);
        return back()->with('success','تم الارسال');
    }

    /***************************  send email  **************************/
    public function sendEmail(Request $request){

        $this->settingRepo->sendEmail($request->all());
        return back()->with('success','تم الارسال');
    }
}
