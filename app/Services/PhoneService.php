<?php
namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Collection;
use App\Exceptions\NotValidCodeException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Common\Enums\Pagination;
class PhoneService
{
    public function getPhoneNumbers(): Collection
    {
        $phones = (new Customer)->getArrayOfPhoneNumbers();
        $phoneNumbersCollection = collect([]);

        foreach ($phones as $phone) {
            try{
                    $phoneNumbersCollection[] = ((new PhoneNumberService())->getDataOfPoneNumber($phone));
                } catch(NotValidCodeException $message) {
                      $phone." exception not valid";
                }
        }

        return $phoneNumbersCollection;
    }

    public function filterPhoneNumbers($country, $state): LengthAwarePaginator
    {
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

