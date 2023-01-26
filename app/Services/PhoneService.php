<?php

namespace App\Services;

use App\Models\phone;
use App\Common\Enums\Pagination;

class PhoneService implements PhoneInterface
{
    public function filter($country, $state)
    {
        return phone::query()->with('country')
        ->when(isset($country) && !is_null($country), function($q) use($country) {
            $q->whereHasCountry($country);
        })
        ->when(isset($state) && !is_null($state),function($q) use($state) {
            $q->whereState($state);
        })
        ->paginate(Pagination::PAGINATION);
    }
}
