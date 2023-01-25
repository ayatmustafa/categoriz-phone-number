<?php

namespace App\Http\Controllers;

use App\Services\PhoneService;
use App\Http\Resources\PhoneCollection;
use App\Http\Requests\PhoneFilterRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PhoneController extends Controller
{
    private $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    public function filter(PhoneFilterRequest $request): ResourceCollection
    {
        return new PhoneCollection($this->phoneService->filterPhoneNumbers($request->country, $request->state));
    }
}
