<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\WarrantyResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'image' => $this->image,
            'color' => $this->color,
            'configuration' => $this->configuration,
            'status' => $this->status,
            'condition' => $this->condition,
            'purchase_price' => $this->purchase_price,
            'warranties' => $this->warranties,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
