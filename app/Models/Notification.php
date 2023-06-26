<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends DatabaseNotification
{
    use HasFactory;
    
    public function getTitleAttribute($value)
    {
        if ($this->data['type'] == 'admin_notify' ) {
            return $this->data['title_'.lang()] ?? __('notification.title_'.$this->data['type']);
        }
        return __('notification.title_'.$this->data['type']);
    }

    public function getBodyAttribute($value)
    {
        if ($this->data['type'] == 'admin_notify' ) {
            return $this->data['message_'.lang()] ;
        }elseif ($this->data['type'] == 'acceptance') {
            return trans('notification.body_' . $this->data['type'] ,['order_num' => $this->data['order_num']]);
        }
        elseif ($this->data['type'] == 'in_progress') {
            return trans('notification.body_' . $this->data['type'] ,['order_num' => $this->data['order_num']]);
        }elseif ($this->data['type'] == 'finish') {
            return trans('notification.body_' . $this->data['type'] ,['order_num' => $this->data['order_num']]);
        }
        elseif ($this->data['type'] == 'cancel') {
            return trans('notification.body_' . $this->data['type'] ,['order_num' => $this->data['order_num']]);
        }

        return  __('notification.body_'.$this->data['type']);
    }

    public function getSenderAttribute($value)
    {
        if(isset($this->data['sender_model'])){
            $def  = 'App\Models\\'.$this->data['sender_model'] ;
            $sender = $def::find($this->data['sender'])  ;
            return [
                'name'   => $sender->name ,
                'avatar' => $sender->avatar ,
            ];
        }

    }


}
