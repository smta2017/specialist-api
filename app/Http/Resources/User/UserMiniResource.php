<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMiniResource extends JsonResource
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
            "id" => $this->id, // 852,
            "name" => $this->name, //"Ludwig Padberg",
            "avatar" => \Request::root() .'/'. $this->avatar, //"Ludwig Padberg",
            "type" => $this->user_type, //"Ludwig Padberg",
        ];
    }
}
