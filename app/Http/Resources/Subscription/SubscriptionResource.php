<?php

namespace App\Http\Resources\Subscription;

use App\Http\Resources\User\UserMiniResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            "user" => new UserMiniResource($this->User), // 5,
            "plan_id" => $this->plan_id, // 9,
            "created_at" => $this->created_at->toDateString(), // "1990-06-18T00:00:00.000000Z",
            "start_at" => $this->start_at->toDateString(), // "1990-06-18T00:00:00.000000Z",
            "end_at" => $this->end_at->toDateString(), // "1990-06-18T00:00:00.000000Z",
            "order_count" => $this->order_count, // 9,
            "expired" => Carbon::now()->gt($this->end_at), // 9,
        ];
    }
}
