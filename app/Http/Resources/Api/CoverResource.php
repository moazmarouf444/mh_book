<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CoverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'back_img' => $this->back_img,
            'edge_img' => $this->edge_img,
            'file_3d' => 'https://mhbook.aait-sa.com/view-cover/' . $this->id,
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
