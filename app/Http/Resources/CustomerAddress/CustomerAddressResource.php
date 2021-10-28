<?php

namespace App\Http\Resources\CustomerAddress;

use App\Http\Resources\User\UserMiniResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerAddressResource extends JsonResource
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
            "id" => $this->id, // 4,
            "user" => new UserMiniResource($this->User), // 5,
            "area_id" => $this->area_id, // 5,
            "street" => $this->street, // "provident",
            "is_default" => $this->is_default, // false,
            "floor_no" => $this->floor_no, // "blanditiis",
            "build_no" => $this->build_no, // "architecto",
            "notes" => $this->notes, // "architecto",
        ];
    }
}
