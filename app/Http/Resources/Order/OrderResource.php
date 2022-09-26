<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "uuid" => $this->uuid,
            "notes" => $this->notes,
            "approved" => $this->approved,
            "store" => $this->store,
            "order_items" => OrderItemsResource::collection($this->order_items),
        ];
    }
}
