<?php

namespace App\Notifications\Orders;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptNotify extends Notification
{
    use Queueable,Firebase;

    private $order;
    private $user;
    private $data;
    private $tokens;
    private $fcm_arr;
    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->tokens = $order->user?->devices;
        $this->data = [

            'type' => 'acceptance',
            'order_num' => $order->order_num,
            'order_id' => $order->id,
        ];


        $this->fcm_arr = [
            'type' => 'acceptance',
            'title_ar' => 'محبوك',
            'title_en' => 'Mh book',
            'body_ar' => 'تم ارسال طلبك رقم '. ' ' .$order->order_num . ' وهو تحت المراجعه الان',
            'body_en' => 'Your order has been sent number'. ' ' .$order->order_num . ' ' .'and is under review',
            'order_id' => $order->id,
        ];

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $user_devices = $this->user->tokens->pluck('name')->toArray();
        if (count($user_devices) > 0) {
            $user_lang = $this->user->lang;

            $this->sendNotification($user_devices, $this->fcm_arr,$user_lang);
        }
//        dd($this->data);
        return $this->data;
    }
}
