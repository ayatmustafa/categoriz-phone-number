<?php
namespace App\Services;
use Illuminate\Support\Facades\Validator;

class MangePhoneNumberService
{
    public  function  resolveCodeRegex(string $code): array
    {
        $regex = [
            '(237)' => ['code' => '(\(237\))' , 'phone' => '/^[2368][0-9]{7,8}$/', 'country' => 'Cameroon'],
            '(251)' => ['code' => '(\(251\))' , 'phone' => '/^[1-59][0-9]{8}$/', 'country' => 'Ethiopia'],
            '(212)' => ['code' => '(\(212\))' , 'phone' => '/^[5-9][0-9]{8}$/', 'country' => 'Morocco'],
            '(258)' => ['code' => '(\(258\))' , 'phone' => '/^[28][0-9]{7,8}$/', 'country' => 'Mozambique'],
            '(256)' => ['code' => '(\(256\))' , 'phone' => '/^[0-9]{9}$/', 'country' => 'Uganda'],
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

    public function getCountryByCode( string $code ): string
    {
        $country = [
            '(237)' => 'Cameroon',
            '(251)' => 'Ethiopia',
            '(212)' => 'Morocco',
            '(258)' => 'Mozambique',
            '(256)' => 'Uganda',
        ];
        return $country[$code]??[];
    }
}

