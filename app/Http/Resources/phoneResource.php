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
    public function toArray($request): array
    {
        return [
            "phoneNumber" => $this->phone_number,
            "country" => $this->country->name,
            "code" =>$this->country->code,
            "state" => $this->state
        ];
    }
}
