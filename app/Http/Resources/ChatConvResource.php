<?php

namespace App\Http\Resources;

use App\Http\Resources\User\UserMiniResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatConvResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'to_user' =>  new UserMiniResource(User::find($this->to_user))
        ];
    }
}
