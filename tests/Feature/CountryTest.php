<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Common\Enums\RouteName;


class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_countries()
    {
        $this->get(route(RouteName::COUNTRIES))
             ->assertStatus(200)
             ->assertJsonStructure([
                'data' => [
                            [
                                "country",
                                "code"
                            ]
                ]
            ]);
    }
}
