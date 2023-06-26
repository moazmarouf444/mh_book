<?php

namespace App\Notifications\Orders;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InProgressNotify extends Notification
{
    use Queueable, Firebase;

    private $order;
    protected $user;
    private $data;
    private $fcm_arr;
    private $tokens;

    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->tokens = $order->user?->devices;

        $this->fcm_arr = [
            'type'          => 'in_progress' ,
            'title_ar' => 'محبوك',
            'title_en' => 'Mh book',
            'body_ar' => 'تم قبول طلبك رقم '. ' ' .$order->order_num . ' وهو قيد التنفيذ الان',
            'body_en' => 'Your order has been accepted number'. ' ' .$order->order_num . ' ' .'and is now in progress',
            'order_id' => $order->id,

        ];

        $this->data = [
            'type' => 'in_progress',
            'order_num' => $order->order_num,
            'order_id' => $order->id,
        ];
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
//        dd($this->tokens);
//        dd($this->user->tokens);
        $user_devices = $this->user->tokens->pluck('name')->toArray();
//            dd($users_devices);
        if (count($user_devices) > 0) {
            $this->sendNotification($user_devices, $this->fcm_arr);
        }
        return $this->data;
    }
}
