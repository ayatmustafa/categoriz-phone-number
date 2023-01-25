<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface PhoneInterface
{
    public function filterPhoneNumbers($country, $state): LengthAwarePaginator;
}
