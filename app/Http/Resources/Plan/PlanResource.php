<?php

namespace App\Http\Resources\Plan;

use App\Http\Resources\Subscription\SubscriptionResource;
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
        $subscripetions = auth()->user()->subscriptions->where('plan_id', $this->id)->where('end_at', '>=', date("Y-m-d"))->first();
        $subscripetionsArray =   $subscripetions;
        // return parent::toArray($request);
        return [
            "id" => $this->id, //1,
            "name" => $this->name, //"porro",
            "price" => $this->price, //40,
            "request_counts" => $this->request_counts, //240,
            "period_in_days" => $this->period_in_days, //null,
            "user_type" => $this->user_type, //"center",
            "can_supscribing_count" => $this->can_supscribing_count, //null,
            'end_at' => $this->end_at,
            'user_in_plane' => $subscripetions ? 1 : 0,
            'approved' => $subscripetions ? $subscripetions->states : 0,
            'subscription_id' => $subscripetionsArray ? $subscripetionsArray->id : 0
        ];
    }
}
