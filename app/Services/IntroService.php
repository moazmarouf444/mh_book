<?php
namespace  App\Services;

class IntroService {

    public static function appInformations($app_info)
    {

        $data                        = [
            'name_ar'                    =>$app_info['name_ar'],
            'name_en'                    =>$app_info['name_en'],
            'about_ar'                   =>$app_info['about_ar'],
            'about_en'                   =>$app_info['about_en'],
            'logo'                       =>$app_info['logo'],
        ];
        return $data;
    }



}
