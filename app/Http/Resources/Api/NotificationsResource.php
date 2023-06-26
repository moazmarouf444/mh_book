<?php

namespace App\Http\Resources\Api;

use App\Traits\NotificationMessageTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource {
  
  public function toArray($request) {
    return [
      'id'      => $this->id,
      'type'    => $this->data['type'],
      'title'   => $this->title,
      'body'    => $this->body,
      'data'    => $this->data,
      'time'    => $this->created_at->format('Y-m-d'),
    ];
  }
}
