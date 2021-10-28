<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\User\UserMiniResource;
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
        // return parent::toArray($request);
        return [
            "id" => $this->id, // 1,
            "title" => $this->title, // "saepe",
            "body" => $this->body, // "Sit deserunt deleniti et officiis. Atque quia cum et quam minus sit eveniet et. Fugiat nesciunt et id in molestiae ut aut corporis.",
            "user" => new UserMiniResource($this->User), // 5,
            "status" => $this->status_id, // 5,
        ];
    }
}
