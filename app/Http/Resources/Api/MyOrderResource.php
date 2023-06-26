<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'date' => $this->created_at->format('d/m/Y'),
            'id' => $this->id,
            'order_num' => $this->order_num,
            'status_text' => $this->status_text,
            'status_const' => $this->status_const,
            'status' => $this->status,
        ];
    }
}
