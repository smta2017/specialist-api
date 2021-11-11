<?php

namespace App\Http\Resources\Plan;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            "id" => $this->id, //1,
            "name" => $this->name, //"porro",
            "price" => $this->price, //40,
            "request_counts" => $this->request_counts, //240,
            "period_in_days" => $this->period_in_days, //null,
            "user_type" => $this->user_type, //"center",
            "can_supscribing_count" => $this->can_supscribing_count, //null,
        ];
    }
}
