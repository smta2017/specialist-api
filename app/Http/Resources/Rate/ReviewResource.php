<?php

namespace App\Http\Resources\Rate;

use App\Http\Resources\User\UserMiniResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            "id" => $this->id, // 2,
            "rating" => $this->rating, // 5,
            "title" => $this->title, // "This is a test title",
            "body" => $this->body, // "And we will add some shit here",
            "recommend" => $this->recommend, // "Yes",
            "author_id" => new UserMiniResource(User::find($this->author_id)), // 1,
        ];
    }
}
