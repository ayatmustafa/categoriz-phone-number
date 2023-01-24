<?php

namespace App\Http\Controllers;

use App\Services\PhoneService;
use App\Http\Resources\PhoneCollection;
use App\Http\Requests\PhoneFilterRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
class PhoneController extends Controller
{
    public function filter(PhoneFilterRequest $request): ResourceCollection
    {
        return new PhoneCollection((new PhoneService())->filterPhoneNumbers($request->country, $request->state));
    }
}
