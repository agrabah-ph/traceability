<?php

namespace Tests\Feature;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use WithoutMiddleware; // use the trait
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProduct()
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

        $this->assertAuthenticatedAs($user);

        $response = $this->get(route("product.create"));
//
        $response->assertStatus(200);

        $faker = Factory::create();
        $create = [
            'name' => $faker->name,
            'description' => $faker->paragraph(3),
        ];


        $response = $this->post(route('product.store'), $create);
        $response->assertStatus(302);

        DB::rollBack();

    }
}
