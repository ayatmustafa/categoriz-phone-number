<?php

namespace App\Http\Resources;

use App\Services\PhoneNumberService;
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
            "phoneNumber" => $this['phoneNumber'],
            "country" => $this['country'] ,
            "state" => $this['state'] ?? (new PhoneNumberService())->validatePhone($this['code'], $this['phoneNumber']),
            'code' => '+'.str_replace( array("(",  ")"), '', $this['code'])
        ];
    }
}
