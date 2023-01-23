<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'data' => phoneResource::collection($this->collection->toArray()),
            'currentPage' => $this->currentPage(),
            'firstPageUrl' => config('app.base_api_url').'/filter'.$this->url(1),
            'from' => $this->firstItem(),
            'lastPage' => $this->lastPage(),
            'lastPageUrl' =>  config('app.base_api_url').'/filter'.$this->url($this->lastPage()),
            'nextPageUrl' =>  $this->currentPage()!=$this->lastPage()? config('app.base_api_url').'/filter'.$this->nextPageUrl():null,
            'path' => $this->path(),
            'perPage' => $this->perPage(),
            'prevPageUrl' => $this->currentPage()!=1?config('app.base_api_url').'/filter'.$this->previousPageUrl():null,
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];

    }
}
