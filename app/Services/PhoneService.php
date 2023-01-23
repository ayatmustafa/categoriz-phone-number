<?php
namespace App\Services;

use App\Exceptions\NotValidCodeException;
use App\Models\Customer;
class PhoneService
{

    public function getPhoneNumbers()
    {
        $phones = (new Customer)->getArrayOfPhoneNumbers();
        $phoneNumbersCollection = collect([]);

        foreach ($phones as $phone) {
            try{
                    $phoneNumbersCollection[] = ((new PhoneNumberService())->getDataOfPoneNumber($phone));
                }catch(NotValidCodeException $e)
                {
                      $phone." exception not valid";
                }
        }
        return $phoneNumbersCollection;
    }

    public function filterPhoneNumbers($country, $state)
    {
       $data = $this->getPhoneNumbers();
       if(isset($country) && !is_null($country)){
        $data = $data->where('country', $country);
       }
       if(isset($state) && !is_null($state)){
        $data = $data->where('state', $state);
       }
       return convertArrayToCollection($data, config('app.paginate'));
    }
}

