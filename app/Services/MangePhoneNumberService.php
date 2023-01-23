<?php
namespace App\Services;

class MangePhoneNumberService
{
    protected $countryService;

    public  function  resolveCodeRegex(string $code): array
    {
        $regex = [
            '(237)' => ['code' => '(\(237\))' , 'phone' => '/^[2368][0-9]{7,8}$/'],
            '(251)' => ['code' => '(\(251\))' , 'phone' => '/^[1-59][0-9]{8}$/'],
            '(212)' => ['code' => '(\(212\))' , 'phone' => '/^[5-9][0-9]{8}$/'],
            '(258)' => ['code' => '(\(258\))' , 'phone' => '/^[28][0-9]{7,8}$/'],
            '(256)' => ['code' => '(\(256\))' , 'phone' => '/^[0-9]{9}$/'],
        ];

        return $regex[$code];
    }

    public function validatePhone( string $code, string $phone): bool
    {
        $regex = $this->resolveCodeRegex($code);
        $checkCode = preg_match($regex['code'], $code);
        $checkPhone = preg_match($regex['phone'], $phone);

        if ($checkCode && $checkPhone) {
            return true;
        }

        return false;
    }

    public  function getDataOfPoneNumber($phone): array
    {
        $arrPhone = explode(')', str_replace(" ","",$phone));
        $code = $arrPhone[0].')';
        $phoneNumber = $arrPhone[1];
        $country = (new CountryService())->getCountryByCode($code);
        $state = $this->validatePhone($code, $phoneNumber);
        return ['country'=> $country , 'state' => $state, 'phoneNumber' => $phoneNumber, 'code' => $code];
    }
}

