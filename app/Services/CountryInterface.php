<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface CountryInterface
{
    public function getCountries(): Collection;

    public function getCountryByCode(string $code): string;
}
