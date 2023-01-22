<?php

namespace App\Console\Commands;

use App\Exceptions\NotValidCodeException;
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
            try{
                $country = $service->getCountryByCode($arrPhone[0]);
                $country = (new Country)->store($country,  "+".trim(trim($arrPhone[0], "("), ")"));
                $country->phones()->create([
                    'phone_number' => $arrPhone['1'],
                    'state' => $service->validatePhone( $arrPhone[0], $arrPhone[1])
                ]);
            }catch(NotValidCodeException $e){
                $this->info($arrPhone[0]." exception not valid");
            }

       }
    }
}
