<?php

namespace App\Services;

use App\Common\Enums\Country;

class PhoneNumberHandler implements PhoneNumberInterface
{
    private function resolveCodeRegex(string $code): array
    {
        $regex = [
            '(' . Country::CAMEROON_CODE . ')' => ['code' => '(\(' . Country::CAMEROON_CODE . '\))', 'phone' => '/^[2368][0-9]{7,8}$/'],
            '(' . Country::ETHIOPIA_CODE . ')' => ['code' => '(\(' . Country::ETHIOPIA_CODE . '\))', 'phone' => '/^[1-59][0-9]{8}$/'],
            '(' . Country::MOROCCO_CODE . ')' => ['code' => '(\(' . Country::MOROCCO_CODE . '\))', 'phone' => '/^[5-9][0-9]{8}$/'],
            '(' . Country::MOZAMBIQUE_CODE . ')' => ['code' => '(\(' . Country::MOZAMBIQUE_CODE . '\))', 'phone' => '/^[28][0-9]{7,8}$/'],
            '(' . Country::UGANDA_CODE . ')' => ['code' => '(\(' . Country::UGANDA_CODE . '\))', 'phone' => '/^[0-9]{9}$/'],
        ];

        return $regex[$code] ?? [];
    }

    public function validatePhone(string $code, string $phone): bool
    {
        $regex = $this->resolveCodeRegex($code);
        $checkCode = preg_match($regex['code'], $code);
        $checkPhone = preg_match($regex['phone'], $phone);

        if ($checkCode && $checkPhone) {
            return true;
        }

        return false;
    }

}
