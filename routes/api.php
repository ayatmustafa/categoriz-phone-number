<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;
use App\Common\Enums\RouteName;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('countries', [CountryController::class, 'index'])->name(RouteName::COUNTRIES);
Route::post('filter', [PhoneController::class, 'filter'])->name(RouteName::FILTER);


