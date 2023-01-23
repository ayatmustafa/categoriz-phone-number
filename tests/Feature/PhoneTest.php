<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    /** @test */
    public function test_filter_phone_numbers()
    {
        $this->post('api/filter', [
            'country' => null,
            'state' => true,
        ])
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                        [
                            "phoneNumber",
                            "country",
                            "state",
                            "code"
                        ]
            ],
        ]);
    }

    /** @test */
    public function test_required_fields_for_filter()
    {
         $this->POST('api/filter', [
            'country' => "wrong data",
            'state' => "wrong state",
            ], ['Accept' => 'application/json']
            )
            ->assertStatus(422)
             ->assertJson([
                "success"=> false,
                "message" => "The given data was invalid.",
                "errors" => [
                    'country' => 'Country Should Be Saved IN Our DB',
                    'state' => 'State Should Be Valid or not Valid',
                ],
            ]);
    }
}
