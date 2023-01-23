<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection((new CountryService)->getCountries());
    }
}
