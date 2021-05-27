<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * @return void
     * @test
     */
    public function registers_successfully()
    {
        $payload = [
            'name' => 'John',
            'last_name' => 'stevy',
            'email' => 'john@marlino.com',
            'phone' => 695782628,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->json('POST', '/api/user/register', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);;
    }

    /** @test */
    public function require_name()
    {
        $this->json('post', '/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "name" => [
                        "The name field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function require_last_name()
    {
        $this->json('post', '/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "last_name" => [
                        "The last name field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function require_phone()
    {
        $this->json('post', '/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "phone" => [
                        "The phone field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function require_email()
    {
        $this->json('post', '/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "email" => [
                        "The email field is required."
                    ]
                ]
            ]);
    }

    /**  @test */
    public function require_password()
    {
        $this->json('post', '/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    /** @test */
    public function password_not_match()
    {
        $payload = [
            'name' => 'John',
            'last_name' => 'stevy',
            'email' => 'john@marlino.com',
            'phone' => 695782628,
            'password' => 'password',
            'password_confirmation' => 'passwords',
        ];

        $this->json('post', '/api/user/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "password" => [
                        "The password confirmation does not match."
                    ]
                ]
            ]);
    }

    /** @test */
    public function email_must_be_a_valid_email_address()
    {
        $payload = [
            'name' => 'John',
            'last_name' => 'stevy',
            'email' => 'john',
            'phone' => 695782628,
            'password' => 'password',
            'password_confirmation' => 'passwords',
        ];

        $this->json('post', '/api/user/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "email" => [
                        "The email must be a valid email address."
                    ]
                ]
            ]);
    }

    /** @test */
    public function all_fields_is_required()
    {
        $this->json('post','/api/user/register')
            ->assertStatus(422)
            ->assertJson([
                "message" => "validation error",
                "error" => [
                    "name" => [
                        "The name field is required."
                    ],
                    "last_name" => [
                        "The last name field is required."
                    ],
                    "phone" => [
                        "The phone field is required."
                    ],
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }
}
