<?php

namespace App\Http\Resources\OrderState;

use App\Http\Resources\User\UserMiniResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderStateResource extends JsonResource
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
            "id" => $this->id, // 6,
            "name" => $this->name, // 9,
        ];
    }
}
