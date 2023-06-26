<?php

namespace App\Traits;

use FCM;
use App\Models\UserToken;
use App\Models\SiteSetting;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Illuminate\Http\Exceptions\HttpResponseException;

trait  Firebase
{
    public function sendNotification($tokens, $data, $user_lang = null)
    {
//        dd($data);
        $lang = $user_lang ?? lang();

        $SERVER_API_KEY = SiteSetting::where('key', 'firebase_key')->first()->value;
        if ($data['type'] == 'admin_notify') {
            $title = $data['title_' . $lang];
            $title_ar = $data['title_ar'];
            $title_en = $data['title_en'];
            $body = $data['message_' . $lang];
            $body_ar = $data['message_ar'];
            $body_en = $data['message_en'];

        } else {
            $title = $data['title_' . $lang];
            $title_ar = $data['title_ar'];
            $title_en = $data['title_en'];
            $body = $data['body_' . $lang];
            $body_ar = $data['body_ar'];
            $body_en = $data['body_en'];

        }
        $data_ = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $title,
                "title_ar" => $title_ar,
                "title_en" => $title_en,
                "body" => $body,
                "body_ar" => $body_ar,
                "body_en" => $body_en,
                "mutable_content" => true,
                'sound' => true
            ],
            "data" => $data
        ];
//        dd($data);
        $dataString = json_encode($data_);
//        dd($dataString);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
//        dd($response);
    }
}

