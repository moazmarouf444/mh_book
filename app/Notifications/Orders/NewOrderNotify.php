<?php

namespace App\Notifications\Orders;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotify extends Notification
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
            'type' => 'new_order',
            'order_num' => $order->order_num,
            'order_id' => $order->id,
        ];


        $this->fcm_arr = [
            'type'          => 'new_order' ,
            'title_ar'      => 'محبوك',
            'title_en'      => 'Mh book',
            'body_ar'       => 'هناك طلب جديد',
            'body_en'       => 'There is a new order',
            'order_id'      => $order->id,

        ];

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
//        $user_devices = $this->user->tokens->pluck('name')->toArray();
//        if (count($user_devices) > 0) {
//            $this->sendNotification($user_devices, $this->fcm_arr);
//        }
        return $this->data;
    }
}
