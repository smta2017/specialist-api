<?php

namespace App\Http\Resources\OrderComment;

use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\User\UserMiniResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCommentResource extends JsonResource
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
            "id" => $this->id, // 1,
            "order" =>  new OrderResource($this->Order), // 7,
            "user" => new UserMiniResource($this->User), // 5,
            "body" => $this->body, // "Omnis aperiam dicta quia ut. Voluptas officia impedit facilis ipsum ratione ut qui et. Non sed temporibus tempore laudantium facilis labore nostrum.",
            "offer" => $this->offer, // 2,
            "delivery_date" => $this->delivery_date->toDateString(), // "2018-01-16T00:00:00.000000Z",
            "created_at" => $this->created_at->toDateString(), // "2006-04-06T13:02:49.000000Z",
        ];
    }
}
