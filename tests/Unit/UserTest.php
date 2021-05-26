<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->assertTrue(true);
    }

    public function testAccountCreatedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $ceoData = [
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
            "year" => "2014",
            "company_headquarters" => "San Bruno, California",
            "what_company_does" => "Video-sharing platform"
        ];

        $this->json('POST', 'api/ceo', $ceoData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "ceo" => [
                    "name" => "Susan Wojcicki",
                    "company_name" => "YouTube",
                    "year" => "2014",
                    "company_headquarters" => "San Bruno, California",
                    "what_company_does" => "Video-sharing platform"
                ],
                "message" => "Created successfully"
            ]);
    }


}
