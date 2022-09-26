<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
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
            "product" => new ProductResource($this->product),
            "quantity" => $this->quantity
        ];
    }
}
