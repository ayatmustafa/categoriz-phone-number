<?php
namespace App\Services;

use Illuminate\Support\Collection;

class CountryService
{
    public function getCountries(): Collection
    {
        return collect([
            ['code' => '(237)' , 'country'=>'Cameroon'],
            ['code' => '(251)' , 'country'=>'Ethiopia'],
            ['code' => '(212)' , 'country'=>'Morocco'],
            ['code' => '(258)' , 'country'=>'Mozambique'],
            ['code' => '(256)' , 'country'=>'Uganda'],
        ]);
    }

    public function getCountryByCode(string $code): string
    {
       return $this->getCountries()->where('code', $code)->first()['country'] ?? '';
    }
}

