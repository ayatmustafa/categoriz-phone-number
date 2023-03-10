<?php

namespace App\Services;

use App\Models\Customer;
use App\Common\Enums\Pagination;
use Illuminate\Support\Collection;
use App\Exceptions\NotValidCodeException;
use Illuminate\Pagination\LengthAwarePaginator;

class PhoneService implements PhoneInterface
{
    private $hasStatus = false, $phoneNumberHandler, $customer;

    public function __construct(PhoneNumberHandler $phoneNumberHandler, Customer $customer)
    {
        $this->phoneNumberHandler = $phoneNumberHandler;
        $this->customer = $customer;
    }

    private function getPhoneNumbers(): Collection
    {
        $phones = $this->customer->getArrayOfPhoneNumbers();
        $phoneNumbersCollection = collect([]);

        foreach ($phones as $phone) {
            try {
                $phoneNumbersCollection[] = $this->phoneNumberHandler->getDataOfPoneNumber($phone, $this->hasStatus);
            } catch (NotValidCodeException $message) {
                $phone . " exception not valid";
            }
        }

        return $phoneNumbersCollection;
    }

    public function filterPhoneNumbers($country, $state): LengthAwarePaginator
    {
        if (isset($state) && !is_null($state)) {
            $this->hasStatus = true;
        }

        $data = $this->getPhoneNumbers();

        if (isset($country) && !is_null($country)) {
            $data = $data->where('country', $country);
        }

        if (isset($state) && !is_null($state)) {
            $data = $data->where('state', $state);
        }

        return convertArrayToCollection($data, Pagination::PAGINATION);
    }
}
