<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminAddMasterFarmerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddMasterFarmer()
    {
        DB::beginTransaction();
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
        $user->assignRole(stringSlug('super-admin'));
        $user->markEmailAsVerified();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

        $response = $this->get(route("master-farmer.create"));

        $response->assertStatus(200);


        $faker = Factory::create();
        $createFarmer = [
            'first-name' => $faker->name,
            'middle-name' => $faker->lastName,
            'last-name' => $faker->lastName,
            'email' => $faker->email,
            'password' => $password = $faker->password,
        ];


        $response = $this->post(route('master-farmer.store'), $createFarmer);
        $response->assertStatus(302);

        DB::rollBack();



    }
}
