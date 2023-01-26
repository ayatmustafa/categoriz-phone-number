<?php

namespace App\Console\Commands;

use App\Exceptions\NotValidCodeException;
use App\Models\Country;
use App\Models\Customer;
use App\Services\CountryService;
use App\Services\PhoneNumberHandler;
use Illuminate\Console\Command;
class CategorizeCountryPhoneNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:categorize-phone-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'categorize customer phone numbers asper country code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $phones = resolve(Customer::class)->getArrayOfPhoneNumbers();

        foreach ($phones as $phone) {
            $arrPhone = explode(')', str_replace(" ", "", $phone));
            $code = $arrPhone[0] ? $arrPhone[0] . ')' : '';
            $phoneNumber = $arrPhone[1] ?? '';
            $service = new PhoneNumberHandler();
            try {
                $country = resolve(CountryService::class)->getCountryByCode($code);
                $country = resolve(Country::class)->store($country,  "+" . trim(trim($code, "("), ")"));
                $country->phones()->firstOrCreate([
                    'phone_number' => $phoneNumber,
                    'state' => $service->validatePhone($code, $phoneNumber)
                ]);
            } catch (NotValidCodeException $e) {
                $this->info($code . " exception not valid");
            }
        }
    }
}
