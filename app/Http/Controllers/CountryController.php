<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection(collect((new CountryService)->getCountries()));
    }
}
