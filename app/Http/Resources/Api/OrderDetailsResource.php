<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource {
  public function toArray($request) {
    return [
      'id'                   => $this->id,
      'order_number'         => $this->order_num,
      'status'               => $this->status,
      'status_const'         => $this->status_const,
      'status_text'          => $this->status_text,
      'education_level_name' => $this->educationLevel->name,
      'papper_size_name'     => $this->paperSize->name,
      'print_form_name'      => $this->printing->name,
//      'has_frame'            => !is_null($this->frame_id),
      'total_price'          => $this->total_price,
      'sr'                   => __('order.sr'),
      'lat'                  => $this->lat,
      'lng'                  => $this->lng,
      'address'              => $this->address,
      'date'                 => $this->created_at->format('d/m/Y'),
      'files'                => $this->orderFiles()->get(['type','file']),
    ];
  }
}
