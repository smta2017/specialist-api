<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Rate\ReviewResource;
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
        $area_name='';
        $city_name='';
        if ($this->CustomerAddresses->count()) {
            $area_name = $this->CustomerAddresses[0]->Area->area_name_ar;
            $city_name =  $this->CustomerAddresses[0]->Area->City->city_name_ar;
        } 
        return [
            "id" => $this->id, // 852,
            "name" => $this->name, //"Ludwig Padberg",
            "email" => $this->email, //"hhackett@example.org",
            "email_verified_at" => $this->email_verified_at, //"2021-10-28T21:38:17.000000Z",
            "created_at" => $this->created_at, //"2021-10-28T21:38:18.000000Z",
            "avatar" => $this->avatar, //"2021-10-28T21:38:18.000000Z",
            "updated_at" => $this->updated_at, //"2021-10-28T21:38:18.000000Z",
            "phone" => $this->phone, // null,
            "phone_verified_at" => $this->phone_verified_at, // null,
            "is_active" => $this->is_active, // null,
            "is_admin" => $this->is_admin, // null,
            "gender" => $this->gender, // null,
            "user_type_id" => $this->user_type_id, // null,
            "dop" => $this->dop, // null,
            "sms_notification" => $this->sms_notification, // null,
            "lang" => $this->lang, // null
            "notes" => $this->notes, // null
            "area" => $area_name, // null
            "city" => $city_name, // null
            "edu" => [
                ['edu' => $this->edu1],
                ['edu' => $this->edu2],
                ['edu' => $this->edu3],
                ['edu' => $this->edu4],
            ], // null
            "rate" => $this->averageRating(1, true)[0]
        ];
    }
}
