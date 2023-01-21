<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneFilterRequest;
use App\Http\Resources\phoneResource;
use App\Models\phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function filter(PhoneFilterRequest $request)
    {
        $phonesNumbers = phone::query()
                            ->when(isset($request->countryId) && !is_null($request->countryId), function($q) use($request) {
                                $q->whereCountry($request->countryId);
                            })
                            ->when(isset($request->state) && !is_null($request->state),function($q) use($request) {
                                $q->whereState($request->state);
                            })
                            ->get();

        return phoneResource::collection($phonesNumbers);
    }
}
