<?php

namespace App\Notifications\Orders;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelNotify extends Notification
{
    use Queueable, Firebase;

    private $order;
    private $user;
    private $data;
    private $fcm_arr;
    private $tokens;

    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->tokens = $order->user?->devices;
        $this->data = [
            'type' => 'cancel',
            'order_num' => $order->order_num,
            'order_id' => $order->id,
        ];


        $this->fcm_arr = [
            'type'          => 'cancel' ,
            'title_ar' => 'محبوك',
            'title_en' => 'Mh book',
            'body_ar' => 'عذرا تم رفض طلبك رقم'  . ' ' .$order->order_num,
            'body_en' => 'Sorry your order number'. ' ' .$order->order_num . ' ' .'has been rejected',
            'order_id' => $order->id,


        ];
//        dd($this->fcm_arr);
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
//        dd(1);
        $user_devices = $this->user->tokens->pluck('name')->toArray();
        if (count($user_devices) > 0) {
//          dd($this->user);
            $user_lang = $this->user->lang;
//            dd(lang());
            $this->sendNotification($user_devices, $this->fcm_arr,$user_lang);
        }
        return $this->data;

    }
}
