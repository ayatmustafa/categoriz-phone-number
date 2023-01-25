<?php

namespace App\Services;


interface PhoneNumberInterface
{
    public function validatePhone(string $code, string $phone): bool;

    public function getDataOfPoneNumber($phone, $hasStatus = false): array;
}
