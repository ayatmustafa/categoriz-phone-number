<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface PhoneInterface
{
    public function filter($country, $state);
}
