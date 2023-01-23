<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneFilterRequest;
use App\Http\Resources\PhoneCollection;
use App\Services\PhoneService;

class PhoneController extends Controller
{
    public function filter(PhoneFilterRequest $request)
    {
        return new PhoneCollection((new PhoneService())->filterPhoneNumber($request->country, $request->state));
    }
}
