<?php

namespace App\Http\Controllers;

use App\Services\PhoneService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PhoneCollection;
use App\Http\Requests\PhoneFilterRequest;

class PhoneController extends Controller
{
    private $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    public function filter(PhoneFilterRequest $request): PhoneCollection
    {
        return  new PhoneCollection($this->phoneService->filterPhoneNumbers($request->country, $request->state));
    }
}
