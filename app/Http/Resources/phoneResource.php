<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class phoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => $this->phone_number,
            "country" => new CountryResource($this->country) ,
            "state" => $this->state
        ];
    }
}
