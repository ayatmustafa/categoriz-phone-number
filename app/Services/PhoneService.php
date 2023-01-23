<?php
namespace App\Services;

use App\Exceptions\NotValidCodeException;
use App\Models\Customer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PhoneService
{

    public function getPhoneNumbers()
    {
        $phones = (new Customer)->getArrayOfPhoneNumbers();
        $phoneNumbersCollection = collect([]);

        foreach ($phones as $phone) {
            try{
                    $phoneNumbersCollection[] = ((new MangePhoneNumberService())->getDataOfPoneNumber($phone));
                }catch(NotValidCodeException $e)
                {
                      $phone." exception not valid";
                }
        }
        return $phoneNumbersCollection;
    }

    public function filterPhoneNumber($country, $state)
    {
       $data = $this->getPhoneNumbers();
       if(isset($country) && !is_null($country)){
        $data = $data->where('country', $country);
       }
       if(isset($state) && !is_null($state)){
        $data = $data->where('state', $state);
       }
       return $this->convertArrayToCollection($data, config('app.paginate'));
    }

      /**
     * helper function to convert array to paginated collection
     *
     * @var collection
     */
    public function convertArrayToCollection($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

