<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(): JsonResponse
    {
        return new JsonResponse(CountryResource::collection($this->countryService->getCountries()), 200);
    }
}
