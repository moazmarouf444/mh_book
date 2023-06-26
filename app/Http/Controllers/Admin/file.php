<?php

namespace App\Jobs;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\NotifyUser ;

class AcceptOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Firebase;

    protected $offer , $data;

    public function __construct($offer)
    {
        $this->data = [
            'sender' => auth()->id(),
            'sender_name' => auth()->user()->name,
            'sender_avatar' => auth()->user()->image,
            'title_ar' => 'قبول عرض السعر',
            'title_en' => 'Accept Offer',
            'message_ar' => ' تم الموافقة علي عرض السعر علي طلب رقم ' . $offer->order_id ,
            'message_en' => 'Offer price accepted on order #' . $offer->order_id ,
            'order_id' => (int) $offer->order_id,
            'offer_id' => (int) $offer->id,
            'type' => 'offer' ,
        ];

        $this->offer = $offer;
    }

    public function handle()
    {
        $user = $this->offer->provider;

        $tokens = [];
        foreach ($user->devices as $device) {
            $tokens[] = $device->device_id ;
        }

        $this->sendNotification($tokens , $this->data) ;
        Notification::send($user, new NotifyUser($this->data));
    }
}

