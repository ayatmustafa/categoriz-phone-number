<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;
class CountryController extends Controller
{
    public function index(): JsonResource
    {
        return CountryResource::collection((new CountryService)->getCountries());
    }
}
