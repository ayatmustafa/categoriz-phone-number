<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneFilterRequest;
use App\Http\Resources\PhoneCollection;
use App\Http\Resources\phoneResource;
use App\Models\phone;
use App\Services\PhoneService;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    private $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    public function filter(PhoneFilterRequest $request)
    {
        return new PhoneCollection($this->phoneService->filter($request->country, $request->state));
    }
}
