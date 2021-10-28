<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\CustomerAddress\CustomerAddressResource;
use App\Http\Resources\OrderComment\OrderCommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        
       
        return [
            'order' => new OrderResource($this),
            'customer_address' => new CustomerAddressResource($this->CustomerAddress),
            'OrderComments' => OrderCommentResource::collection($this->OrderComments)
        ];
    }
}
