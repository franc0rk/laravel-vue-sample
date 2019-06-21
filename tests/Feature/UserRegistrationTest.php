<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_is_succesfully_registered()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];


        $response = $this->post(route('register', $data));

        unset($data['password']);
        unset($data['password_confirmation']);

        $this->assertDatabaseHas('users', $data);
    }

    /** @test */
    function a_user_profile_is_created_after_user_registration()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];


        $response = $this->post(route('register', $data));

        $this->assertDatabaseHas('user_profiles', [
            'bio' => null,
            'birthday' => null,
            'website' => null,
            'gender' => null,
            'phone' => null,
            'user_id' => \App\User::first()->id,
        ]);
    }

    /** @test */
    function a_user_address_is_created_after_user_registration()
    {
        $this->withoutExceptionHandling();
        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];


        $response = $this->post(route('register', $data));

        $this->assertDatabaseHas('user_addresses', [
            'line_1' => null,
            'line_2' => null,
            'city' => null,
            'state' => null,
            'user_id' => \App\User::first()->id,
        ]);
    }

    /** @test */
    function new_users_are_redirected_to_profile_after_registration()
    {
        $this->withoutExceptionHandling();
        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];


        $response = $this->post(route('register', $data));

        $response->assertRedirect('user-profile');
    }

    /** @test */
    function users_complete_their_profiles()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];


        $response = $this->post(route('register', $data));

        $user = \App\User::first();

        $response = $this->put(route('user-profile.update'), [
            'bio' => 'lorem',
            'website' => 'https://localhost.me',
            'phone' => '12345678',
            'gender' => 'M',
            'birthday' => '1990-01-01',
        ]);

        $response->assertRedirect('/user-address');

        $this->assertDatabaseHas('user_profiles', [
            'bio' => 'lorem',
            'website' => 'https://localhost.me',
            'phone' => '12345678',
            'gender' => 'M',
            'birthday' => '1990-01-01',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    function users_fill_an_address_after_filling_profile_data()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest',
        ];

        $response = $this->post(route('register', $data));

        $user = \App\User::first();

        $response = $this->put(route('user-address.update'), [
            'line_1' => 'lorem',
            'line_2' => 'ipsum',
            'city' => 'Test',
            'state' => 'Test',
            'zip_code' => '12345',
        ]);

        $this->assertDatabaseHas('user_addresses', [
            'line_1' => 'lorem',
            'line_2' => 'ipsum',
            'city' => 'Test',
            'state' => 'Test',
            'zip_code' => '12345',
        ]);

        $response->assertRedirect('/app/home');
    }
}
