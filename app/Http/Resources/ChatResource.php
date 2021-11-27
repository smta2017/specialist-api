<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'from_user' => $this->from_user,
            'to_user' => $this->to_user,
            'msg' => $this->msg,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
