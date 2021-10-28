<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "email" => $this->email, //"hhackett@example.org",
            "email_verified_at" => $this->email_verified_at, //"2021-10-28T21:38:17.000000Z",
            "created_at" => $this->created_at, //"2021-10-28T21:38:18.000000Z",
            "updated_at" => $this->updated_at, //"2021-10-28T21:38:18.000000Z",
            "phone" => $this->phone, // null,
            "phone_verified_at" => $this->phone_verified_at, // null,
            "is_active" => $this->is_active, // null,
            "is_admin" => $this->is_admin, // null,
            "gender" => $this->gender, // null,
            "user_type" => $this->user_type, // null,
            "dop" => $this->dop, // null,
            "sms_notification" => $this->sms_notification, // null,
            "lang" => $this->lang, // null
        ];
    }
}
