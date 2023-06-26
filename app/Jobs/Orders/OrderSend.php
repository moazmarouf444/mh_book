<?php

namespace App\Jobs\Orders;

use App\Notifications\NotifyUser;
use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,Firebase;
    protected $order , $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->data = [
            'sender' => auth()->id(),
            'sender_name' => auth()->user()->name,
            'sender_avatar' => auth()->user()->image,
            'title_ar' => 'ارسال طلب',
            'title_en' => 'Send Order',
            'message_ar' => 'تم ارسال طلبك رقم ' . $order->order_num .' '. 'وهو تحت المراجعه الان' ,
            'message_en' => 'Your order number has been sent' . $order->order_num . ' ' . 'It is under review now',
            'order_id' => (int) $order->order_id,
            'offer_id' => (int) $order->id,
            'type' => 'order_send' ,
        ];

        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->order->user;

        $tokens = [];
        foreach ($user->devices()->get() as $device) {
            $tokens[] = $device->device_id;
        }

        $this->sendNotification($tokens , $this->data) ;
        Notification::send($user, new NotifyUser($this->data));
    }
}
