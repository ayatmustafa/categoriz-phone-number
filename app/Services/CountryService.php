<?php

namespace App\Services;

use App\Common\Enums\Country;
use Illuminate\Support\Collection;

class CountryService implements CountryInterface
{
    public function getCountries(): Collection
    {
        return collect([
            ['code' => '(' . Country::CAMEROON_CODE . ')', 'country' => Country::CAMEROON],
            ['code' => '(' . Country::ETHIOPIA_CODE . ')', 'country' => Country::ETHIOPIA],
            ['code' => '(' . Country::MOROCCO_CODE . ')', 'country' => Country::MOROCCO],
            ['code' => '(' . Country::MOZAMBIQUE_CODE . ')', 'country' => Country::MOZAMBIQUE],
            ['code' => '(' . Country::UGANDA_CODE . ')', 'country' => Country::UGANDA],
        ]);
    }

    public function getCountryByCode(string $code): string
    {
        return $this->getCountries()->where('code', $code)->first()['country'] ?? '';
    }
}
