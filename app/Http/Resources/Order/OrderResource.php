<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Store\StoreResource;
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
            "order_num" => $this->id,
            "uuid" => $this->uuid,
            "notes" => $this->notes,
            "status" => $this->status,
            "store" => new StoreResource($this->store),
            "order_items" => OrderItemsResource::collection($this->order_items),
        ];
    }
}
