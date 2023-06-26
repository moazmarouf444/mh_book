<?php

namespace App\Notifications\Orders;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinishNotify extends Notification
{
    use Queueable,Firebase;
    private $order;
    private $user;
    private $data;
    private $tokens;

    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->tokens = $order->user?->devices;

        $this->data = [
            'type' => 'finish',
            'order_num' => $order->order_num,
            'order_id' => $order->id,
        ];


        $this->fcm_arr = [
            'type'          => 'finish' ,
            'title_ar' => 'محبوك',
            'title_en' => 'Mh book',
            'body_ar' => 'تم تحويل طلبك رقم ' . ' ' .$order->order_num . ' ' .'الي الطلبات المنتهيه',
            'body_en' => 'The order number'. ' ' .$order->order_num . ' ' .'has been transferred to the completed orders',
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
            $this->sendNotification($user_devices, $this->fcm_arr);
        }
        return $this->data;
    }
}
