<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(): JsonResource
    {
        return CountryResource::collection($this->countryService->getCountries());
    }
}
