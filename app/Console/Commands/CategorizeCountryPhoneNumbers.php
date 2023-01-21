<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Customer;
use App\Services\MangePhoneNumberService;
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
       $phones = Customer::select('phone')->pluck('phone')->toArray();

       foreach ($phones as $phone) {
            $arrPhone = explode(' ', $phone);
            $service = new MangePhoneNumberService();
            $regex = $service->resolveCodeRegex($arrPhone[0]);
            $country = (new Country)->store($regex['country'],  "+".trim(trim($arrPhone[0], "("), ")"));
            $country->phones()->create([
                'phone_number' => $arrPhone['1'],
                'state' => $service->validatePhone($regex, $arrPhone[0], $arrPhone[1])
                ]);
       }
    }
}
