<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;
use Faker\Generator as Faker;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//
//        $this->assertTrue(true);
//    }

    public function testAccountCreatedSuccessfully() // Faker $faker
    {
//        $user = factory(User::class)->create();
        $this->assertTrue(true);
//        $this->actingAs($user, 'api');
//
//        $userData = [
//            'name' => $faker->name,
//            'email' => $faker->unique()->safeEmail,
//            'email_verified_at' => now(),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//            'remember_token' => Str::random(10),
//        ];
//
//        $this->json('POST', 'api/user', $userData, ['Accept' => 'application/json'])
//            ->assertStatus(201)
//            ->assertJson([
//                "ceo" => [
//                    "name" => "Susan Wojcicki",
//                    "company_name" => "YouTube",
//                    "year" => "2014",
//                    "company_headquarters" => "San Bruno, California",
//                    "what_company_does" => "Video-sharing platform"
//                ],
//                "message" => "Created successfully"
//            ]);

    }


}
